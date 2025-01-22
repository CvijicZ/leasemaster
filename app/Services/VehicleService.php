<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Services\LeaseCostService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class VehicleService
{
    private LeaseCostService $leaseCostService;

    public function __construct(LeaseCostService $leaseCostService)
    {
        $this->leaseCostService = $leaseCostService;
    }

    public function getAllVehicles()
    {
        $user = Auth::user();

        $allVehiclesRaw = Vehicle::with(['images', 'contract']);

        // If user role is not admin, filter out contracts to return only contracts related to auth user
        if (!$user->is_admin) {
            $allVehiclesRaw->whereHas('contract', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $vehicles = $allVehiclesRaw->get();

        foreach ($vehicles as $vehicle) {
            $costs = $this->leaseCostService->calculateLeasingCost($vehicle->value, $vehicle->miles, $vehicle->year);
            $vehicle->price_per_month = $costs['monthly_price'];

            $vehicle->status = $vehicle->contract ? ($vehicle->contract->valid_until > now() ? 'leased' : 'expired') : 'available';

            if ($vehicle->contract) {
                $vehicle->user = User::findOrFail($vehicle->contract->user_id);

                $vehicle->contract_id = $vehicle->contract->id;
                $vehicle->contract_created_at = $vehicle->contract->created_at->toDateString();

                $validUntil = Carbon::parse($vehicle->contract->valid_until)->startOfDay();

                $expiresIn = Carbon::now()->startOfDay()->diffInDays($validUntil, false);
                $vehicle->expires_in = max($expiresIn, 0);
                $vehicle->contract_valid_until = $validUntil->toDateString();
            }
        }

        return $vehicles;
    }
}
