<?php

namespace App\Models;

class VotingResultNominee {
    public $name;
    public $votes;
    public function __construct($index, $data) {
        $nominee = Nominee::find($index);
        $this->name = $nominee->first_name . " " . $nominee->last_name . " *" . $nominee->year_of_birth;
        $this->votes = $data;
    }
}
class VotingResultList {
    private ElectionList $list;
    private $data;
    public function __construct($index, $data) {
        $this->list = ElectionList::find($index);
        $this->data = $data;
    }

    public function list_name() {
        return $this->list->name;
    }

    public function nominees() {
        $result = [];
        foreach ($this->data as $index => $data) {
            $result[] = new VotingResultNominee($index, $data);
        }
        return $result;
    }
}

class VotingResult {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function election_name() {
        return Election::find(1)->name;
    }

    public function lists() {
        $result = [];
        foreach ($this->data as $index => $data) {
            $result[] = new VotingResultList($index, $data);
        }

        return $result;
    }
}