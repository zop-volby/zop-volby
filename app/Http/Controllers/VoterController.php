<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;

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

    public static function normalize_second_factor($input) {
        if (!is_numeric($input)) {
            throw new \InvalidArgumentException('Input must be numeric');
        }

        return str_pad($input, 8, '0', STR_PAD_LEFT);
    }

    public function activate(Voter $voter) {
        $voter->is_active = $voter->is_active ? false : true;
        $voter->save();
        return redirect()->route('voters.index');
    }
}
