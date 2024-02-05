<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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
}
