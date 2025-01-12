<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContractRequest;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Log;

class ContractController extends Controller
{

    public function create(CreateContractRequest $request)
    {
        $contract = $this->prepareContractData($request);

        if (is_string($contract)) {
            return redirect()->back()->withErrors($contract);
        }

        try{
            return view('user.create-contract', ['contract' => $contract]);

        }
        catch (\Exception $e) {
            Log::error('Failed to create contract: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred while creating the contract. Please try again.');
        }
    }

    public function store(CreateContractRequest $request)
    {
        $contract = $this->prepareContractData($request);

        if (is_string($contract)) {
            return redirect()->back()->withErrors($contract);
        }

        try {
            Contract::create($contract);
            $vehicle=Vehicle::find($contract['vehicle_id']);
            $vehicle->status=Vehicle::STATUS_LEASED;
            $vehicle->leased_by=Auth::user()->id;
            $vehicle->save();

            return redirect()->route('vehicles.show', ['id' => $contract['vehicle_id']])
    ->with('success', 'Contract created successfully!');

        } catch (\Exception $e) {
            Log::error('Failed to create contract: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred while creating the contract. Please try again.');
        }
    }


    private function prepareContractData(CreateContractRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();

        $vehicle = Vehicle::find($validated['vehicle_id']);
        if (!$vehicle) {
            return 'Vehicle not found.';
        }

        if ($vehicle->status === "leased") {
            return 'Vehicle is already leased.';
        }

        $costs = VehicleController::calculateBaseLeasingCost(
            $vehicle->value,
            $vehicle->miles,
            $vehicle->year,
            $validated['annual_miles'],
            $validated['contract_months']
        );

        return [
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'user_name' => $user->name,
            'vehicle' => $vehicle,
            'contract_months' => $validated['contract_months'],
            'annual_miles' => $validated['annual_miles'],
            'initial_payment' => $costs['initial_payment'],
            'total_price' => $costs['total_price'],
            'price_per_month' => $costs['monthly_price'],
            'valid_until' => now()->addMonths((int) $validated['contract_months'])->toDateString(),
        ];
    }
}
