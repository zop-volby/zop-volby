<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Ballot extends Model
{
    use HasFactory, RevisionableTrait;

    protected $fillable = [
        'voting_id',
        'list_id',
        'is_invalid',
        'votes'
    ];

    public function lists() {
        return $this->belongsTo(ElectionList::class, 'list_id');
    }
}
