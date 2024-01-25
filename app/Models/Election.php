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

    public function get_datetime() {
        return date('d. m. Y H:i', strtotime($this->start_at));
    }
}
