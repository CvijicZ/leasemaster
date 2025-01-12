<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Contract;

class DashboardController extends Controller
{
    public function index()
    {
        $statusCounts = Vehicle::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        $numberOfUsers= User::count();

        $totalVehicles = $statusCounts->sum();
        $availableVehicles = $statusCounts[Vehicle::STATUS_AVAILABLE] ?? 0;
        $leasedVehicles = $statusCounts[Vehicle::STATUS_LEASED] ?? 0;
        $vehiclesUnderMaintenance = $statusCounts[Vehicle::STATUS_MAINTENANCE] ?? 0;

    $months = range(1, 12);

    $leasedVehiclesByMonth = Contract::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->pluck('count', 'month')
        ->toArray();

    $leasedVehiclesByMonthComplete = [];
    foreach ($months as $month) {
        $leasedVehiclesByMonthComplete[$month] = $leasedVehiclesByMonth[$month] ?? 0;
    }

        $data = [
            'total_vehicles' => $totalVehicles,
            'available_vehicles' => $availableVehicles,
            'leased_vehicles' => $leasedVehicles,
            'vehicles_under_maintenance' => $vehiclesUnderMaintenance,
            'number_of_users' => $numberOfUsers,
            'leased_vehicles_by_month' => $leasedVehiclesByMonth,
        ];

        return view('admin.dashboard', $data);
    }
}
