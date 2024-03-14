<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Models\Voter;
use App\Models\Ballot;

class VoterController extends Controller
{
    public function index() {
        $voters = Voter::all();
        return view('voters.index', compact('voters'));
    }

    public function get_load() {
        Gate::authorize('preparation');
        return view('voters.load');
    }

    public function post_load(Request $request) {
        Gate::authorize('preparation');
        $request->validate([
            'voters_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('voters_file');
        $created = 0;
        $failed = 0;
        if (($handle = fopen($file->getRealPath(), "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                try {
                    $hash = VoterController::normalize_second_factor($data[1]);
                }
                catch (\InvalidArgumentException $e) {
                    $failed++;
                    continue;
                }
                $voter = Voter::firstOrCreate([
                    'voter_code' => $data[0],
                    'secret_hash' => password_hash($hash, PASSWORD_DEFAULT)                
                ]);
                if ($voter->wasRecentlyCreated) {
                    $created++;
                }
            }
            fclose($handle);
        }

        return redirect()
                    ->route('voters.index')
                    ->with('status', 'Voliči byli úspěšně nahráni. Počet nových záznamů: ' . $created . ', počet chyb: ' . $failed);
    }

    public function get_scan() {
        Gate::authorize('mail-voting');
        return view('voters.scan');
    }

    public function post_scan(Request $request) {
        Gate::authorize('mail-voting');
        $request->validate([
            'voter_code' => 'required'
        ]);

        $voter = Voter::where('voter_code', $request->voter_code)->first();
        if (!$voter) {
            return redirect()
                        ->route('voters.scan')
                        ->withErrors(['Volič s tímto kódem nebyl nalezen.']);
        }

        if ($voter->mail_voting) {
            return redirect()
                        ->route('voters.scan')
                        ->withErrors(['Tento volič už bylo pro listinné hlasování načten.']);
        }

        DB::transaction(function () use ($voter) {
            $voter->mail_voting = true;
            $voter->save();

            if ($voter->voting_id) {
                $ballot = Ballot::where('voting_id', $voter->voting_id)->first();
                $ballot->is_invalid = true;
                $ballot->save();
            }
        });

        return redirect()
                    ->route('voters.scan')
                    ->with('status', 'Volič byl úspěšně načten pro listinné hlasování.');
    }

    public static function normalize_second_factor($input) {
        if (!is_numeric($input)) {
            throw new \InvalidArgumentException('Input must be numeric');
        }

        return str_pad($input, 8, '0', STR_PAD_LEFT);
    }

    public function activate(Voter $voter) {
        Gate::authorize('admin');
        $voter->is_active = $voter->is_active ? false : true;
        $voter->save();
        return redirect()->route('voters.index');
    }
}
