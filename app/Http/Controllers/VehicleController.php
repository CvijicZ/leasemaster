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
use App\Services\VehicleService;

class VehicleController extends Controller
{
    private $leaseCostService;
    private $vehicleService;

    public function __construct(LeaseCostService $leaseCostService, VehicleService $vehicleService)
    {
        $this->leaseCostService = $leaseCostService;
        $this->vehicleService = $vehicleService;
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
        $vehicles = $this->vehicleService->getAllVehicles();

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
