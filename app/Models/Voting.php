<?php

namespace App\Models;

class Voting {
    public $voter_code;
    public $secret_token;

    public $voting_id;

    public $votes;
    public $voting_time;

    public function load_ballots() {
        $ballots = Ballot::where('voting_id', $this->voting_id)->get();
        $this->voting_time = date('d. m. Y H:i', strtotime($ballots->first()->created_at));

        $this->votes = [];
        foreach ($ballots as $ballot) {
            $this->votes[$ballot->list_id] = $ballot->votes;
        }
    }

    public function getLists() {
        return ElectionList::all();
    }

    public function getNominees($list_id) {
        return ElectionList::find($list_id)->getAssignedNominees();
    }

    public function votes_count($list_id) {
        if (!isset($this->votes[$list_id])) {
            // user didn't send any votes for this list
            return 0;  
        }

        return count(explode(',', $this->votes[$list_id]));
    }

    public function is_checked($list, $nominee) {
        if (!isset($this->votes[$list])) {
            // user didn't send any votes for this list
            return false;
        }

        return str_contains($this->votes[$list], $nominee);
    }
}

