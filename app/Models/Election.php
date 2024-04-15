<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionPhases {
    const PREPARATION = 'preparation';
    const DIGITAL_VOTING = 'digital-voting';
    const MAIL_VOTING = 'mail-voting';
    const INPERSON_VOTING = 'inperson-voting';
    const RESULT_PROCESSING = 'result-processing';    
    const FINISHED = 'finished';
}

class ElectionResults {
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function get_size() {
        return count($this->data);
    }

    public function get_value($index) {
        return $this->data[$index];
    }

    public function get_style($index) {
        $percentage = 100*$this->data[$index]/$this->data[0];
        return "width:$percentage%";
    }

    private $colors = ['', 'secondary', 'success', 'info', 'danger'];

    public function get_color($index) {
        return $this->colors[$index];
    }
    
    private $labels = ['', 'not-voted-yet', 'digital-voting', 'mail-voting', 'invalid-voting'];

    public function get_label($index) {
        return $this->labels[$index];
    }
}

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hyperlink',
        'start_at',
        'end_at',
        'phase',
    ];

    public function get_header() {
        $phase_label = __('election.phase.' . $this->phase);
        return $this->name . ' | ' . $phase_label;
    }

    public function get_startdate() {
        return date('d. m. Y', strtotime($this->start_at));
    }
    public function get_starttime() {
        return date('H:i', strtotime($this->start_at));
    }
    public function get_enddate() {
        return date('d. m. Y', strtotime($this->end_at));
    }
    public function get_endtime() {
        return date('H:i', strtotime($this->end_at));
    }

    public function get_phases() {
        return [
            ElectionPhases::PREPARATION,
            ElectionPhases::DIGITAL_VOTING,
            ElectionPhases::MAIL_VOTING,
            ElectionPhases::INPERSON_VOTING,
            ElectionPhases::RESULT_PROCESSING,
            ElectionPhases::FINISHED,
        ];
    }

    private $results;

    private function check_results() {
        if (!$this->results) {
            $voters = Voter::all();
            $data = [0, 0, 0, 0, 0];
            foreach ($voters as $voter) {
                if ($voter->voting_id) {
                    if ($voter->mail_voting) {
                        $data[4]++;  // both voting - invalid
                    }
                    else {
                        $data[2]++;  // digital voting
                    }
                }
                else {
                    if ($voter->mail_voting) {
                        $data[3]++;  // mail voting
                    }
                    else {
                        $data[1]++;  // not voted yet
                    }
                }
            }
            $data[0] = max($data[1], $data[2], $data[3], $data[4]);

            $this->results = new ElectionResults($data);
        }
    }

    public function get_chart(): ElectionResults {
        $this->check_results();
        return $this->results;
    }
}
