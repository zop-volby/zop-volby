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

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_at',
        'phase',
    ];

    public function get_header() {
        $phase_label = __('election.phase.' . $this->phase);
        return $this->name . ' | ' . $phase_label;
    }

    public function get_datetime() {
        return date('d. m. Y H:i', strtotime($this->start_at));
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

    private $data;

    public function get_chart() {
        if (!$this->data) {
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
        }

        return $data;
    }
}
