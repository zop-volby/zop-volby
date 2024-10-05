<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Nominee extends Model
{
    use HasFactory, RevisionableTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'year_of_birth',
        'biography',
        'link_to_page',
    ];

    public function electionLists()
    {
        return $this->belongsToMany(ElectionList::class);
    }

    public function getAllElectionLists()
    {
        return ElectionList::all();
    }
}
