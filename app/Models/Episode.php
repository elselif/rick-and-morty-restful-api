<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $table = "episodes";

    protected $fillable = [
        'name',
        'air_date',
        'episode',
        'url',
    ];



    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    // public function characters()
    // {
    //     return $this->belongsToMany(Character::class, 'character_episode');
    // }
}
