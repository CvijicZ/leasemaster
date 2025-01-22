<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Http\Requests\CreateVehicleRequest;
use App\Models\User;
use App\Models\VehicleImage;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Services\LeaseCostService;

class VehicleController extends Controller
{
    private $leaseCostService;

    public function __construct(LeaseCostService $leaseCostService)
    {
        $this->leaseCostService = $leaseCostService;
    }
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|integer|exists:vehicles,id',
        ]);

        $vehicle = Vehicle::find($validated['vehicle_id']);

        $vehicle->delete();

        return redirect()->route('admin.rentals')->with('success', 'Vehicle deleted successfully.');
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $leasingCosts = $this->leaseCostService->calculateLeasingCost(
            $vehicle->value,
            $vehicle->miles,
            $vehicle->year
        );

        return view('vehicles.show', compact('vehicle', 'leasingCosts'));
    }

    public function index()
    {
        $vehicles = Vehicle::with('images')->get();

        foreach ($vehicles as $vehicle) {
            $costs = $this->leaseCostService->calculateLeasingCost($vehicle->value, $vehicle->miles, $vehicle->year);

            $user = User::find($vehicle->leased_by);

            $contract = $vehicle->contract;
            if ($contract) {
                $vehicle->contract_id = $contract->id;
                $createdAt = $contract->created_at->toDateString();
                $validUntil = $contract->valid_until ? $contract->valid_until->toDateString() : null;

                if ($validUntil) {

                    $validUntil = Carbon::parse($validUntil)->startOfDay();
                    $expires_in = Carbon::now()->startOfDay()->diffInDays($validUntil, false);
                    $vehicle->expires_in = max($expires_in, 0);
                    $vehicle->contract_created_at = $createdAt;
                    $vehicle->contract_valid_until = Carbon::parse($validUntil)->toDateString();
                } else {
                    $vehicle->expires_in = null;
                }
            }

            $vehicle->price_per_month = $costs['monthly_price'];

            if ($user) {
                $vehicle->user = $user;
            }
        }

        return compact('vehicles');
    }

    public function create()
    {
        return view('vehicles.create-vehicle');
    }

    public function store(CreateVehicleRequest $request)
    {
        $validated = $request->validated();

        try {

            $vehicle = Vehicle::create($validated);

            if ($request->hasFile('images')) {

                $images = $request->file('images');
                foreach ($images as $image) {
                    VehicleImage::saveVehicleImage($image, $vehicle->id);
                }
            }

            return redirect()->route('admin.rentals')
                ->with('success', 'Vehicle created successfully!');
        } catch (\Exception $e) {
            return response()->redirectToRoute('admin.rentals')
                ->withErrors(['error' => 'An error occurred while creating the vehicle. Please try again.']);
        }
    }
}
