<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContractRequest;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VehicleController;

class ContractController extends Controller
{

    public function create(CreateContractRequest $request)
    {
        $user = Auth::user();
        $validated=$request->validated();

        $vehicle = Vehicle::find($validated['vehicle_id']);
        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        if ($vehicle->status === "leased") {
            return response()->json(['error' => 'Vehicle is already leased'], 400);
        }

        $costs=VehicleController::calculateBaseLeasingCost($vehicle->value, $vehicle->miles, $vehicle->year, $validated['annual_miles'], $validated['contract_length']);

        $contract = [
            'user_name' => $user->name,
            'vehicle' => $vehicle,
            'contract_length' => $validated['contract_length'],
            'annual_miles' => $validated['annual_miles'],
            'initial_payment' => $costs['initial_payment'],
            'total_price' => $costs['total_price'],
            'price_per_month' => $costs['monthly_price'],
            'valid_until' => now()->addMonths((int) $validated['contract_length'])->toDateString(),
            'costs' => $costs
        ];
    
        return view('user.create-contract', ['contract' => $contract]);
    }
    
}
