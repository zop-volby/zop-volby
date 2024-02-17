<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;

function normalize_second_factor($input) {
    return $input;
}

class VoterController extends Controller
{
    public function index() {
        $voters = Voter::all();
        return view('voters.index', compact('voters'));
    }

    public function get_load() {
        return view('voters.load');
    }

    public function post_load(Request $request) {
        $request->validate([
            'voters_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('voters_file');
        $created = 0;
        if (($handle = fopen($file->getRealPath(), "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $voter = Voter::firstOrCreate([
                    'voter_code' => $data[0],
                    'secret_hash' => normalize_second_factor($data[1])
                ]);
                if ($voter->wasRecentlyCreated) {
                    $created++;
                }
            }
            fclose($handle);
        }

        return redirect()
                    ->route('voters.index')
                    ->with('status', 'Voliči byli úspěšně nahráni. Počet nových záznamů: ' . $created);
    }
}
