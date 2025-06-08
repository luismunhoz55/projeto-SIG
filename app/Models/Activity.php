<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'start',
        'end',
        'duration',
        'distance'
    ];

    public function positions()
    {
        return $this->hasMany(Position::class);
    }
}
