<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;
use App\Models\Voting;
use Firebase\JWT\JWT;

class VotingController extends Controller
{
    public function index()
    {
        $model = new Voting();
        return view('voting.index', compact('model'));
    }

    public function store(Request $request) {
        if ($request->voter_code == null) {
            return redirect()
                    ->route('voting.index')
                    ->with('status', 'Musíte zadat kód voliče');
        }

        $voter = Voter::where('voter_code', $request->voter_code)->first();
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
        $model->voter_code = $request->voter_code;

        if ($request->secret_token != null) {
            // voting was done, let's process the result
            return view('voting.thanks', compact('model'));
        }
        else if ($request->secret_value != null) {
            // secret value was provided, we can let the user in
            $secret_value = VoterController::normalize_second_factor($request->secret_value);
            if (password_verify($secret_value, $voter->secret_hash)) {
                session(['status' => null]);
                $key = config('voting.jwt_key');
                $payload = [
                    'iss' => 'ZOP Volby',
                    'sub' => $voter->voter_code,
                    'aud' => 'voting execution',
                    'exp' => time() + 60 * 60 * 12    // 12 hours
                ];
                $model->secret_token = JWT::encode($payload, $key, 'HS256');
                return view('voting.index', compact('model'));
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
}
