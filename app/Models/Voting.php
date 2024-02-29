<?php

namespace App\Models;

class Voting {
    public $voter_code;
    public $secret_token;

    public function getLists() {
        return ElectionList::all();
    }

    public function getNominees($list_id) {
        return ElectionList::find($list_id)->getAssignedNominees();
    }
}

