@extends('layouts.admin')

@section('admin-content')
    <div class="container-fluid">
        <h2 class="text-custom-primary mb-4">Vehicle Rentals</h2>

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-md-3">
                <select class="form-control" id="statusFilter">
                    <option value="">All</option>
                    <option value="leased">Leased</option>
                    <option value="garage">Garage</option>
                    <option value="available">Available</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="customerFilter" placeholder="Search by Customer Name">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="vehicleFilter" placeholder="Search by Vehicle Make/Model">
            </div>
        </div>

        <!-- Vehicle Cards -->
        <div class="row">
            @forelse ($vehicles as $vehicle)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 vehicle-card"
                     data-status="{{ $vehicle->status }}"
                     data-customer="{{ $vehicle->leased_by ? 'Leased to User ID: ' . $vehicle->leased_by : 'Not Leased' }}"
                     data-vehicle-name="{{ $vehicle->make . ' ' . $vehicle->model }}">
                    <div class="card shadow-sm bg-custom-secondary text-custom-primary h-100">
                        @php
                        // TODO: find a better way of storing and showing images
                        $imageDirectory = public_path("images/vehicles/{$vehicle->id}");
                        
                        $firstImage = is_dir($imageDirectory) 
                            ? collect(glob($imageDirectory . '/1.*'))->first() 
                            : null;
                    @endphp
                    
                    <img src="{{ $firstImage ? asset("images/vehicles/{$vehicle->id}/" . basename($firstImage)) : asset('images/no-image-available.jpg') }}" 
                         class="card-img-top" 
                         alt="{{ $vehicle->make . ' ' . $vehicle->model }}" 
                         style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $vehicle->make . " " . $vehicle->model }}</h5>
                            <p class="card-text">
                                <strong>Customer:</strong>
                                @if ($vehicle->leased_by)
                                    Leased to User ID: {{ $vehicle->leased_by }}
                                @else
                                    Not Leased
                                @endif
                                <br>
                                <strong>Rental Period:</strong> Placeholder<br>
                                <strong>Status:</strong>
                                <span class="badge 
                                    @if($vehicle->status == 'leased')
                                        bg-success
                                    @elseif($vehicle->status == 'garage')
                                        bg-warning
                                    @else
                                        bg-danger
                                    @endif
                                ">{{ $vehicle->status }}</span>
                            </p>
                            <div class="mt-auto">
                                <a href="#" class="btn btn-sm btn-primary me-2">
                                    <i class="fa-solid fa-edit"></i> Edit
                                </a>
                                <form action="#" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger me-2">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                                <a href="#" class="btn btn-sm btn-info">
                                    <i class="fa-solid fa-eye"></i> Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No vehicles found.</p>
                </div>
            @endforelse
        </div>

        <!-- Add Rental Button -->
        <div class="mt-4">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                <i class="fa-solid fa-plus"></i> Add New Rental
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get filter inputs
            const statusFilter = document.getElementById('statusFilter');
            const customerFilter = document.getElementById('customerFilter');
            const vehicleFilter = document.getElementById('vehicleFilter');
            
            // Get all vehicle cards
            const vehicleCards = document.querySelectorAll('.vehicle-card');
            
            // Function to filter vehicles
            function filterVehicles() {
                const statusValue = statusFilter.value.toLowerCase();
                const customerValue = customerFilter.value.toLowerCase();
                const vehicleValue = vehicleFilter.value.toLowerCase();
                
                vehicleCards.forEach(card => {
                    const status = card.getAttribute('data-status').toLowerCase();
                    const customer = card.getAttribute('data-customer').toLowerCase();
                    const vehicleName = card.getAttribute('data-vehicle-name').toLowerCase();
                    
                    if (
                        (statusValue === "" || status.includes(statusValue)) &&
                        (customerValue === "" || customer.includes(customerValue)) &&
                        (vehicleValue === "" || vehicleName.includes(vehicleValue))
                    ) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            statusFilter.addEventListener('change', filterVehicles);
            customerFilter.addEventListener('input', filterVehicles);
            vehicleFilter.addEventListener('input', filterVehicles);
        });
    </script>
    

    <!-- Add New Vehicle Modal -->
<div class="modal fade" id="addVehicleModal" tabindex="-1" role="dialog" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-custom text-custom-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="addVehicleModalLabel">Add New Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="make">Make</label>
                        <input type="text" class="form-control" id="make" name="make" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                    <div class="form-group">
                        <label for="engine">Engine</label>
                        <input type="text" class="form-control" id="engine" name="engine" required>
                    </div>
                    <div class="form-group">
                        <label for="miles">Miles</label>
                        <input type="number" class="form-control" id="miles" name="miles" required>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" id="color" name="color" required>
                    </div>
                    <div class="form-group">
                        <label for="seats">Seats</label>
                        <input type="number" class="form-control" id="seats" name="seats" required>
                    </div>
                    <div class="form-group">
                        <label for="transmission">Transmission</label>
                        <input type="text" class="form-control" id="transmission" name="transmission" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="number" class="form-control" id="year" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="fuel_consumption">Fuel Consumption (L/100km)</label>
                        <input type="number" class="form-control" id="fuel_consumption" name="fuel_consumption" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label for="value">Value</label>
                        <input type="number" class="form-control" id="value" name="value" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save Vehicle</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <!-- Add Rental Modal -->
    <!-- Modal content here... -->
@endsection
