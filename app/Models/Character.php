<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $table = "characters";

    protected $fillable = [
        'name',
        'status',
        'species',
        'type',
        'gender',
        'origin',
        'location',
        'image',
    ];

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    }
