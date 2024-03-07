<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ballot extends Model
{
    use HasFactory;

    protected $fillable = [
        'voting_id',
        'list_id',
        'votes'
    ];

    public function lists() {
        return $this->belongsTo(ElectionList::class, 'list_id');
    }
}
