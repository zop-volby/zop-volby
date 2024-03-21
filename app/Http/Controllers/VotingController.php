<?php

namespace App\Http\Controllers;

use App\Models\ElectionList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Voter;
use App\Models\Voting;
use App\Models\Ballot;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class VotingController extends Controller
{
    public function index()
    {
        Gate::authorize('digital-voting');
        $model = new Voting();
        return view('voting.index', compact('model'));
    }

    public function store(Request $request) {
        Gate::authorize('digital-voting');
        if ($request->voter_code == null) {
            return redirect()
                    ->route('voting.index')
                    ->with('status', 'Musíte zadat kód voliče');
        }

        $voter = Voter::where('voter_code', strtoupper($request->voter_code))->first();
        if ($voter == null) {
            return redirect()
                    ->route('voting.index')
                    ->with('status', 'Vámi zadaný kód voliče nebyl nalezen');
        }

        if (!$voter->is_active) {
            return redirect()
                    ->route('voting.index')
                    ->with('status', 'Vámi zadaný kód voliče není aktivní');
        }

        $model = new Voting();
        $model->voter_code = $voter->voter_code;

        if ($request->secret_token != null) {
            return $this->finish_voting($model, $request);
        }
        else if ($request->secret_value != null) {
            // secret value was provided, we can let the user in
            $secret_value = VoterController::normalize_second_factor($request->secret_value);
            if (password_verify($secret_value, $voter->secret_hash)) {
                if ($voter->voting_id != null) {
                    $model->voting_id = $voter->voting_id;
                    $model->load_ballots();
                    return view('voting.result', compact('model'));
                }
                else {
                    $this->start_voting($model);
                    return view('voting.index', compact('model'));
                }
            }
            else {
                session(['status' => 'Vámi zadané členské číslo není správné']);
                return view('voting.index', compact('model'));
            }
        }
        else {
            // secret value was not provided, let's ask for it
            return view('voting.index', compact('model'));
        }
    }

    private function start_voting($model) {
        session(['status' => null]);
        $key = config('voting.jwt_key');
        $payload = [
            'iss' => 'ZOP Volby',
            'sub' => $model->voter_code,
            'aud' => 'voting execution',
            'exp' => time() + 60 * 60 * 12    // 12 hours
        ];
        $model->secret_token = JWT::encode($payload, $key, 'HS256');
    }

    private function finish_voting($model, $request) {
        $key = config('voting.jwt_key');
        try {
            $decoded = JWT::decode($request->secret_token, new Key($key, 'HS256'));
        }
        catch (\Exception $e) {
            return redirect()
                    ->route('voting.index')
                    ->with('status', 'Váš čas pro hlasování vypršel');
        }

        if ($decoded->sub != $model->voter_code) {
            return redirect()
                    ->route('voting.index')
                    ->with('status', 'Váš čas pro hlasování vypršel');
        }

        $voting_id = base64_encode(uniqid(true) . random_bytes(10));

        DB::transaction(function () use ($model, $request, $voting_id) {
            $voter = Voter::where('voter_code', $model->voter_code)->first();
            $voter->voting_id = $voting_id;
            $voter->save();

            $lists = ElectionList::all();
            foreach ($lists as $list) {
                $votes = $request->input('list_' . $list->id);
                if ($votes != null) {
                    $ballot = new Ballot();
                    $ballot->voting_id = $voting_id;
                    $ballot->list_id = $list->id;
                    $ballot->votes = $votes;
                    $ballot->save();
                }
            }
        });

        // voting was done, let's process the result
        return view('voting.thanks', compact('model'));
    }
}
