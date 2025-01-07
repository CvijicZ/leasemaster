@extends('layouts.app')

@section('content')
<div class="container-fluid bg-custom-light py-5">

    <!-- Vehicle Details Header -->
    <div class="text-center mb-5">
        <h1 class="display-4 text-custom-primary fw-bold">{{ $vehicle->make }} {{ $vehicle->model }}</h1>
        <p class="lead text-custom-secondary">{{ $vehicle->engine }} | {{ $vehicle->transmission }} | {{ $vehicle->year }}</p>
        <div class="d-flex justify-content-center gap-3 mb-4">
            <span class="badge bg-custom-primary text-custom-primary">Special Offer</span>
            <span class="badge bg-custom-success text-custom-primary">In Stock</span>
            <span class="badge bg-custom-info text-primary">{{ $vehicle->year }} Model</span>
        </div>
    </div>

 <!-- Vehicle Image Gallery and Personalize Your Lease in the same row -->
<div class="row justify-content-center mb-5">
    <!-- Image Gallery Column -->
    <div class="col-lg-6 col-md-9 mb-4 mb-md-0">
        <div id="vehicleCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php
                    $imageDirectory = public_path("images/vehicles/{$vehicle->id}");
                    $images = is_dir($imageDirectory) ? glob($imageDirectory . '/*') : [];
                @endphp

                @if (count($images) > 0)
                    @foreach ($images as $index => $imagePath)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset("images/vehicles/{$vehicle->id}/" . basename($imagePath)) }}" 
                                 alt="{{ $vehicle->make }} {{ $vehicle->model }}" 
                                 class="d-block w-100 rounded-lg shadow-lg">
                        </div>
                    @endforeach
                @else
                    <div class="carousel-item active">
                        <img src="{{ asset('images/no-image-available.jpg') }}" 
                             alt="No image available" 
                             class="d-block w-100 rounded-lg shadow-lg">
                    </div>
                @endif
            </div>

            @if (count($images) > 0)
                <button class="carousel-control-prev" type="button" data-bs-target="#vehicleCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#vehicleCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </div>
</div>


        <!-- Personalize Your Lease Column -->
        <div class="col-lg-5 col-md-5">
            <div class="bg-custom-secondary text-custom-primary rounded-lg p-4 shadow-lg">
                <h5 class="text-center mb-4">Personalize Your Lease</h5>
                <form>
                    <!-- Contract Length -->
                    <div class="mb-4">
                        <label class="form-label">Contract Length (months)</label>
                        <div class="btn-group w-100" role="group">
                            @foreach ([24, 36, 48] as $length)
                                <button type="button" class="btn btn-outline-custom-primary">{{ $length }}</button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Annual Miles -->
                    <div class="mb-4">
                        <label class="form-label">Annual Miles</label>
                        <input type="range" class="form-range" min="5000" max="30000" step="5000" value="10000" id="annualMiles">
                        <div class="d-flex justify-content-between">
                            <span>5K</span>
                            <span>30K</span>
                        </div>
                    </div>

                    <!-- Initial Payment -->
                    <div class="mb-4">
                        <label class="form-label">Initial Payment (months)</label>
                        <div class="btn-group w-100" role="group">
                            @foreach ([1, 3, 6, 9, 12] as $payment)
                                <button type="button" class="btn btn-outline-custom-primary">{{ $payment }}</button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price and Action -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            <p class="mb-1">Personal Lease</p>
                            <h3 class="text-custom-primary fw-bold">£273.12</h3>
                            <small class="text-muted">Initial payment: £2,458.08 inc VAT</small>
                        </div>
                        <a href="#" class="btn btn-outline-primary">Enquire</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Vehicle Details Section (Below Image Gallery & Lease) -->
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="bg-custom-secondary text-custom-primary rounded-lg p-4 shadow-lg">
                <h5 class="text-center mb-4">Vehicle Details</h5>
            
                <div class="row">
                    <!-- Column 1: Make, Transmission, Engine, Fuel Type -->
                    <div class="col-md-6 mb-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                <i class="bi bi-car-front fs-5  me-3"></i>
                                <div><strong>Make:</strong> {{ $vehicle->make }}</div>
                            </li>
                            <li class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary bg-custom text-custom-primary">
                                <i class="bi bi-gear fs-5 me-3"></i>
                                <div><strong>Transmission:</strong> {{ $vehicle->transmission }}</div>
                            </li>
                            <li class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary bg-custom text-custom-primary">
                                <i class="bi bi-cogs fs-5 me-3"></i>
                                <div><strong>Engine:</strong> {{ $vehicle->engine }}</div>
                            </li>
                            <li class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary bg-custom text-custom-primary">
                                <i class="bi bi-fuel-pump fs-5 me-3"></i>
                                <div><strong>Fuel Type:</strong> {{ $vehicle->fuel_type }}</div>
                            </li>
                        </ul>
                    </div>
            
                    <!-- Column 2: Year, Seats, Doors, Color, Miles -->
                    <div class="col-md-6 mb-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                <i class="bi bi-calendar fs-5 me-3"></i>
                                <div><strong>Year:</strong> {{ $vehicle->year }}</div>
                            </li>
                            <li class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                <i class="bi bi-person-lines-fill fs-5 me-3"></i>
                                <div><strong>Seats:</strong> {{ $vehicle->seats }}</div>
                            </li>
                      
                            <li class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                <i class="bi bi-palette fs-5 me-3"></i>
                                <div><strong>Color:</strong> {{ $vehicle->color }}</div>
                            </li>
                            <li class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                <i class="bi bi-tachometer fs-5 me-3"></i>
                                <div><strong>Miles:</strong> {{ $vehicle->miles }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</div>


<!-- Custom CSS -->
<style>
#vehicleCarousel {
    height: 450px;
    overflow: hidden;
    border-radius: 15px;
}

.carousel-inner img {
    object-fit: cover;
    height: 100%;
    border-radius: 15px;
}

.carousel-control-prev-icon, .carousel-control-next-icon {
    filter: invert(100%);
}
</style>

@endsection
