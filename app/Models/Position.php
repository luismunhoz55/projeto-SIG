<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{

    use HasUlids;

    protected $fillable = [
        'latitude',
        'longitude',
        'registered_at',
        'activity_id'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
