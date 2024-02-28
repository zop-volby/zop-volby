<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;
use App\Models\Voting;

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

        $model = new Voting();
        $model->voter_code = $request->voter_code;

        if ($request->secret_value == null) {
            return view('voting.index', compact('model'));
        }
        else {
            $secret_value = VoterController::normalize_second_factor($request->secret_value);
            if (password_verify($secret_value, $voter->secret_hash)) {
                session(['status' => null]);
                $model->secret_value = $request->secret_value;
                return view('voting.index', compact('model'));
            }
            else {
                session(['status' => 'Vámi zadané členské číslo není správné']);
                return view('voting.index', compact('model'));
            }
        }
    }
}
