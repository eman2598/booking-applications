<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = ['name', 'description', 'category_id', 'location', 'type', 'price', 'start_date', 'end_date', 'max_attendence'];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn(int $price) => $price / 100,
            set: fn(int $price) => $price * 100,
        );
    }
}
