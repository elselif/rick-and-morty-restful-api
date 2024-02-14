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
        'origin_id',
        'location_id',
    ];

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }

    public function origin()
    {
        return $this->belongsTo(Location::class, 'origin_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    }
