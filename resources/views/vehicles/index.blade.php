@extends('layouts.admin')

@section('admin-content')
<style>
    .status-badge {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    font-weight: bold;
    color: #fff;
    border-radius: 0 0 0 0.5rem; /* Rounded corner for the top-right */
}

</style>
    <div class="container-fluid">
        <h2 class="text-custom-primary mb-4">Vehicle Rentals</h2>

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-md-3">
                <select class="form-control" id="statusFilter">
                    <option value="">All</option>
                    <option value="leased">Leased</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="available">Available</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="customerFilter" placeholder="Search by Customer Email">
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
            data-customer= {{ $vehicle->user ? $vehicle->user['email'] : 'Not Leased' }} 
            data-vehicle-name="{{ $vehicle->make . ' ' . $vehicle->model }}">
            <div class="card shadow-sm bg-custom text-custom-secondary h-100">
                @php
                    // TODO: find a better way of storing and showing images
                    $imageDirectory = public_path("images/vehicles/{$vehicle->id}");
                    $firstImage = is_dir($imageDirectory)
                        ? collect(glob($imageDirectory . '/1.*'))->first()
                        : null;
                @endphp

                <div class="position-relative">
                    <img src="{{ $firstImage ? asset("images/vehicles/{$vehicle->id}/" . basename($firstImage)) : asset('images/no-image-available.jpg') }}"
                        class="card-img-top" alt="{{ $vehicle->make . ' ' . $vehicle->model }}"
                        style="height: 200px; object-fit: cover;">
                    <!-- Status badge overlay -->
                    <span class="status-badge position-absolute top-0 end-0 badge 
                        @if ($vehicle->status == 'leased') bg-warning
                        @elseif($vehicle->status == 'available')
                            bg-success
                        @else
                            bg-danger @endif
                    ">
                        {{ $vehicle->status }}
                    </span>
                </div>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $vehicle->make . ' ' . $vehicle->model }}</h5>
                    <p class="card-text">
                        @if ($vehicle->user)
                            <strong>Customer:</strong> {{ $vehicle->user['name'] }}<br>
                            <strong>Customer email:</strong> {{ $vehicle->user['email'] }} <br>
                            <strong>Rental Period:</strong> <i class="fa-solid fa-calendar-days"></i> {{ $vehicle->contract_created_at }} 
                            <i class="fa-solid fa-arrow-right"></i> {{ $vehicle->contract_valid_until }}
                            <br>
                            <span class="text-primary">
                                <strong>Expires in: <i class="fa-regular fa-calendar-days"></i></strong> 
                                {{ $vehicle['contract_duration'] }} days.
                            </span><br>
                        @else
                            <strong>Not Leased</strong> <br>
                        @endif
                        <strong>Status:</strong>
                        <span
                            class="badge 
                            @if ($vehicle->status == 'leased') bg-warning
                            @elseif($vehicle->status == 'available')
                                bg-success
                            @else
                                bg-danger @endif
                        ">
                            {{ $vehicle->status }}
                        </span>
                    </p>
                    <div class="mt-auto mx-auto">
                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-sm btn-info">
                            <i class="fa-solid fa-eye"></i> Vehicle
                        </a>
                        @if($vehicle->contract_id)
                        <a href="{{route('admin.contract.show', $vehicle->contract_id) }}" class="btn btn-sm btn-info">
                            <i class="fa-solid fa-eye"></i> Contract
                        </a>
                        @endif
                        <a href="#" class="btn btn-sm btn-primary me-2">
                            <i class="fa-solid fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('vehicles.delete') }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}" />
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i> Delete Vehicle
                            </button>
                        </form>
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
@endsection
