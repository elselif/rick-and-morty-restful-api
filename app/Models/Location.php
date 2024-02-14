<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = "locations";

    protected $fillable = [
        'id',
        'name',
        'type',
        'dimension',
        'url',

    ];

    // Bir lokasyonda birden fazla karakter olabileceğini belirtiyoruz
    public function characters()
    {
        return $this->hasMany(Character::class, 'location_id');
    }



}
