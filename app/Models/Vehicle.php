<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contract;

class Vehicle extends Model
{
    public const STATUS_AVAILABLE = 'available';
    public const STATUS_LEASED = 'leased';
    public const STATUS_MAINTENANCE = 'maintenance';

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }
    
    protected $fillable = [
        'make', 'model', 'engine', 'miles', 'color', 'seats', 'transmission', 'year', 'fuel_consumption', 'value'
    ];

    protected $attributes = [
        'status' => Vehicle::STATUS_AVAILABLE,
        'leased_by' => null,
    ];
}
