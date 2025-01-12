@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="text-center py-5"
        style="background-image: url('images/hero.jpg'); background-size: cover; background-position: center;">
        <div class="container transparent-bg-primary p-2">
            <h1 class="display-4 text-custom-primary">Your Journey Starts Here</h1>
            <p class="lead text-custom-secondary">Affordable plans, diverse vehicles, and exceptional service.</p>
            <a href="#" class="btn btn-primary btn-lg">Browse Vehicles</a>
            <a href="#" class="btn btn-secondary btn-lg">Get Started</a>
        </div>
    </section>

    <!-- Featured Vehicles -->
    <section>
        <div class="container bg-custom-secondary p-4 mt-4">
            <h2 class="text-center mb-5">Featured Vehicles</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($vehicles as $vehicle)
                @if($vehicle->status != "leased")
                    <div class="col">
                        <div class="card bg-custom text-custom-primary shadow-sm h-100">

                            @php
                                $vehicleDir = public_path("images/vehicles/{$vehicle->id}");

                                $imageFiles = glob("{$vehicleDir}/1.{jpg,jpeg,png,gif}", GLOB_BRACE);

                                if ($imageFiles) {
                                    $imagePath = url("images/vehicles/{$vehicle->id}/" . basename($imageFiles[0]));
                                }
                            @endphp

                            <img src="{{ $imagePath }}" class="card-img-top img-fluid"
                                alt="{{ $vehicle->make }} {{ $vehicle->model }}" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $vehicle->make }} {{ $vehicle->model }}</h5>
                                <p class="card-text text-success fs-5 font-weight-bold">From
                                    ${{ number_format($vehicle->price_per_month, 2) }}/month</p>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <p class="card-text">Engine: {{ $vehicle->engine }}</p>
                                        <p class="card-text">Year: {{ $vehicle->year }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="card-text">Seats: {{ $vehicle->seats }}</p>
                                        <p class="card-text">Miles: {{ number_format($vehicle->miles, 0) }}</p>
                                    </div>
                                </div>
                                <a href="/vehicles/{{$vehicle->id}}" class="btn btn-primary w-100 mt-3">Lease Now</a>
                                <button class="btn btn-outline-secondary w-100 mt-2 show-more-btn" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#details{{ $vehicle->id }}"
                                    aria-expanded="false" aria-controls="details{{ $vehicle->id }}">Show more</button>
                                <div class="collapse mt-2" id="details{{ $vehicle->id }}">
                                    <p class="card-text">Transmission: {{ $vehicle->transmission }}</p>
                                    <p class="card-text">Color: {{ $vehicle->color }}</p>
                                    <p class="card-text">Seats: {{ $vehicle->seats }}</p>
                                    <p class="card-text">Fuel Cons.: {{ $vehicle->fuel_consumption }} L / 100km</p>
                                    <button class="btn btn-outline-secondary w-100 mt-2 show-less-btn" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#details{{ $vehicle->id }}"
                                        aria-expanded="true" aria-controls="details{{ $vehicle->id }}">Show Less</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

@endSection
