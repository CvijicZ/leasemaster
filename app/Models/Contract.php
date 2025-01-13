<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Vehicle;

class Contract extends Model
{
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'contract_months',
        'annual_miles',
        'initial_payment',
        'total_price',
        'price_per_month',
        'valid_until'
    ];

    protected $casts = [
        'valid_until' => 'datetime',
        'created_at' => 'datetime',
    ];
}
