@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid bg-custom-light py-5">

        <!-- Vehicle Details Header -->
        <div class="text-center mb-5">
            <h1 class="display-4 text-custom-primary fw-bold">{{ $vehicle->make }} {{ $vehicle->model }}</h1>
            <p class="lead text-custom-secondary">{{ $vehicle->engine }} | {{ $vehicle->transmission }} |
                {{ $vehicle->year }}</p>
            <div class="d-flex justify-content-center gap-3 mb-4">
                <span class="badge bg-custom-primary text-custom-primary">Special Offer</span>
                <span class="badge bg-custom-success text-custom-primary">In Stock</span>
                <span class="badge bg-custom-info text-primary">{{ $vehicle->year }} Model</span>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Personalize Your Lease Column -->
            <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                <div class="bg-custom text-custom-secondary rounded-lg p-4 shadow-lg w-100">
                    <h5 class="text-center mb-4">Personalize Your Lease</h5>

                    <form action="{{ route('lease.create') }}" method="GET" id="leaseForm">
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                        <!-- Contract Length -->
                        <div class="mb-4">
                            <label for="contractLength" class="form-label">Contract Length (months)</label>
                            <select class="form-select" name="contract_months" id="contractLength">
                                @foreach ([24, 36, 48] as $length)
                                    <option value="{{ $length }}" {{ $length == 24 ? 'selected' : '' }}>
                                        {{ $length }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Annual Miles -->
                        <div class="mb-4">
                            <label for="annualMiles" class="form-label">Annual Miles</label>
                            <select class="form-select" name="annual_miles" id="annualMiles">
                                @foreach (range(5000, 30000, 5000) as $miles)
                                    <option value="{{ $miles }}" {{ $miles == 5000 ? 'selected' : '' }}>
                                        {{ $miles / 1000 }}K
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price and Action -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <p class="mb-1">Personal Lease</p>
                                <h3 class="text-custom-primary fw-bold" id="monthlyPrice">$
                                    {{ $leasingCosts['monthly_price'] }} / month</h3>
                                <small class="text-custom-secondary">Initial payment:
                                    £<span id="initialPayment">{{ $leasingCosts['initial_payment'] }}</span></small>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Enquire</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Vehicle Details Column -->
            <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                <div class="bg-custom text-custom-secondary rounded-lg p-4 shadow-lg w-100">
                    <h5 class="text-center mb-4">Vehicle Details</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                    <i class="bi bi-car-front fs-5  me-3"></i>
                                    <div><strong>Make:</strong> {{ $vehicle->make }}</div>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                    <i class="bi bi-gear fs-5 me-3"></i>
                                    <div><strong>Transmission:</strong> {{ $vehicle->transmission }}</div>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                    <i class="fa-solid fa-gears fs-5 me-3"></i>
                                    <div><strong>Engine:</strong> {{ $vehicle->engine }}</div>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                    <i class="bi bi-fuel-pump fs-5 me-3"></i>
                                    <div><strong>Fuel Type:</strong> {{ $vehicle->fuel_type }}</div>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                    <i class="bi bi-calendar fs-5 me-3"></i>
                                    <div><strong>Year:</strong> {{ $vehicle->year }}</div>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                    <i class="bi bi-person-lines-fill fs-5 me-3"></i>
                                    <div><strong>Seats:</strong> {{ $vehicle->seats }}</div>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                    <i class="bi bi-palette fs-5 me-3"></i>
                                    <div><strong>Color:</strong> {{ $vehicle->color }}</div>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center border-0 bg-custom text-custom-primary">
                                    <i class="fa-solid fa-road fs-5 me-3"></i>
                                    <div><strong> Miles:</strong> {{ $vehicle->miles }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicle Image Gallery and Personalize Your Lease in the same row -->
        <div class="row justify-content-center mb-5">
            <!-- Image Gallery Column -->
            <div class="col-lg-6 col-md-9 mb-4 mb-md-0">
                <div id="vehicleCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">


                        @if ($vehicle->images)
                            @foreach ($vehicle->images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image->path) }}"
                                        alt="{{ $vehicle->make }} {{ $vehicle->model }}"
                                        class="d-block w-100 rounded-lg shadow-lg">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <img src="{{ asset('images/no-image-available.jpg') }}" alt="No image available"
                                    class="d-block w-100 rounded-lg shadow-lg">
                            </div>
                        @endif
                    </div>

                    @if ($vehicle->images)
                        <button class="carousel-control-prev" type="button" data-bs-target="#vehicleCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#vehicleCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
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
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const leasingCosts = {!! json_encode($leasingCosts) !!};

            function updateLeasingCost() {
                const selectedContractLength = document.querySelector('.contract-length-btn.active') || document
                    .querySelector('.contract-length-btn');
                const contractLength = selectedContractLength ? selectedContractLength.innerText : 24;

                const annualMiles = document.getElementById('annualMiles').value;

                const defaultAnnualMiles = 5000;

                let mileageImpact = (annualMiles - defaultAnnualMiles) / 10000;
                let monthlyPrice = leasingCosts.monthly_price + (mileageImpact *
                    100);
                let totalPrice = contractLength * monthlyPrice;

                document.getElementById('monthlyPrice').innerText = `$${monthlyPrice.toFixed(2)} / month`;
                document.getElementById('totalPriceDisplay').innerText = `Total: £${totalPrice.toFixed(2)}`;
            }

            document.querySelectorAll('.contract-length-btn').forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.contract-length-btn').forEach(btn => btn.classList
                        .remove('active'));
                    this.classList.add('active');
                    updateLeasingCost();
                });
            });

            document.getElementById('annualMiles').addEventListener('input', updateLeasingCost);
        });
    </script>

@endsection
