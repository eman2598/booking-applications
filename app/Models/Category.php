<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

use function Pest\Laravel\get;

class Category extends Model
{
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $name) => ucfirst($name),
            set: fn(string $name) => strtolower($name),
        );
    }
}
