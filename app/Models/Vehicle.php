<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'make', 'model', 'engine', 'miles', 'color', 'seats', 'transmission', 'year', 'fuel_consumption', 'value'
    ];

    protected $attributes = [
        'status' => 'garage',
        'leased_by' => null,
    ];
}
