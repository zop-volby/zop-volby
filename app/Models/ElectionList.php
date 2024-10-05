<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class ElectionList extends Model
{
    use HasFactory, RevisionableTrait;

    protected $fillable = [
        'name',
        'description',
        'max_votes',
    ];

    public function nominees()
    {
        return $this->belongsToMany(Nominee::class);
    }

    public function getAllNominees()
    {
        return Nominee::orderBy('last_name')->get();
    }

    public function getAssignedNominees() {
        return $this->nominees()->orderBy('last_name')->get();
    }
    public function getAvailableNominees() {
        return Nominee::whereNotIn('id', $this->nominees->pluck('id'))->orderBy('last_name')->get();
    }

}
