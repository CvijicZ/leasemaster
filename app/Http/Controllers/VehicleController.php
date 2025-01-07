<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Http\Requests\CreateVehicleRequest;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{

    public function index()
    {
        $vehicles = Vehicle::all();

        return compact('vehicles');
    }

    public function create(){
        return view('vehicles.create-vehicle');
    }

    public function store(CreateVehicleRequest $request)
{
    $validated = $request->validated();

    $acceptedFormats = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'webp'];

    try {

        $vehicle = Vehicle::create($validated);

        if ($request->hasFile('images')) {
            $directory = public_path('images/vehicles/' . $vehicle->id);
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $images = $request->file('images');
            foreach ($images as $index => $image) {
                $extension = strtolower($image->getClientOriginalExtension());
                if (!in_array($extension, $acceptedFormats)) {
                    throw new \Exception('Invalid image format: ' . $extension);
                }

                $imageName = ($index + 1) . '.' . $extension;

                $image->move($directory, $imageName);
            }
        }

        return redirect()->route('admin.rentals')
            ->with('success', 'Vehicle created successfully!');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response()->redirectToRoute('admin.rentals')
            ->withErrors(['error' => 'An error occurred while creating the vehicle. Please try again.']);
    }
}

    
    
    

    public function show($id)
    {
        // Fetch the vehicle by ID
        $vehicle = Vehicle::findOrFail($id);

        // Fetch lease options (example data, replace with actual query if needed)
        $leaseOptions = [
            ['duration' => '12 months', 'price' => 2000],
            ['duration' => '24 months', 'price' => 1800],
            ['duration' => '36 months', 'price' => 1500],
        ];

        return view('vehicles.show', compact('vehicle', 'leaseOptions'));
    }
}
