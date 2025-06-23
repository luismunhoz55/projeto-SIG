<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    use HasUlids;

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
