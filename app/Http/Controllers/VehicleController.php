<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Http\Requests\CreateVehicleRequest;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $leasingCosts = self::calculateBaseLeasingCost(
            $vehicle->value,
            $vehicle->miles,
            $vehicle->year
        );

        return view('vehicles.show', compact('vehicle', 'leasingCosts'));
    }


    public function index()
    {
        $vehicles = Vehicle::all();

        foreach ($vehicles as $vehicle) {
            $costs = self::calculateBaseLeasingCost($vehicle->value, $vehicle->miles, $vehicle->year);
            $vehicle->price_per_month = $costs['monthly_price'];
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

    public static function calculateBaseLeasingCost(
        float $value,
        float $miles,
        int $year,
        int $annualMiles = 5000, // Default value matching the JS code
        int $contractMonths = 24 // Default contract length
    ): array {

        // Base depreciation rate per year
        $depreciationRate = 0.15;

        // Mileage depreciation factor
        $mileageDepreciationFactor = 0.01;

        // Base annual leasing percentage of vehicle value
        $leasingPercentage = 0.15;

        // Initial payment multiplier
        $initialPaymentMultiplier = 6;

        // Default annual mileage used for calculations
        $defaultAnnualMiles = 5000;

        // Calculate vehicle depreciation based on its age
        $age = (int) date("Y") - $year;
        $depreciatedValue = $value * pow(1 - $depreciationRate, max(0, $age));

        // Adjust for mileage depreciation
        $mileageAdjustmentFactor = floor($miles / 10000) * $mileageDepreciationFactor;
        $finalValue = $depreciatedValue * (1 - $mileageAdjustmentFactor);

        // Ensure the vehicle value doesn't drop below a minimum threshold
        $finalValue = max($finalValue, $value * 0.2);

        // Calculate the base annual and monthly leasing costs
        $annualLeasingCost = $finalValue * $leasingPercentage;
        $monthlyLeasingCost = $annualLeasingCost / 12;

        // Adjust monthly price based on annual mileage
        $mileageImpact = ($annualMiles - $defaultAnnualMiles) / 10000;
        $adjustedMonthlyPrice = $monthlyLeasingCost + ($mileageImpact * 100);

        // Calculate total price based on contract length
        $totalPrice = $adjustedMonthlyPrice * $contractMonths;

        // Calculate the initial payment
        $initialPayment = $monthlyLeasingCost * $initialPaymentMultiplier;

        return [
            'initial_payment' => round($initialPayment, 2),
            'monthly_price' => round($adjustedMonthlyPrice, 2),
            'total_price' => round($totalPrice, 2),
        ];
    }
}
