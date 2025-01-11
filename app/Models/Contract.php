<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'contract_months',
        'annual_miles',
    ];
}
