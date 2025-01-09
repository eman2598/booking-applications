<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'events_id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }
}
