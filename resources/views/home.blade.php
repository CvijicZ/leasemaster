@extends('layouts.app')

@section('title', 'Home')


@section('content')
<!-- Hero Section -->
<section class="text-center py-5" style="background-image: url('images/hero.jpg'); background-size: cover; background-position: center;">
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
            <!-- Vehicle 1 -->
            <div class="col">
                <div class="card bg-custom text-custom-primary shadow-sm h-100">
                    <img src="{{url('images/1.jpg')}}" class="card-img-top img-fluid" alt="Vehicle 1" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Audi R8</h5>
                        <p class="card-text text-success fs-5 font-weight-bold">From $299/month</p>
                        <div class="row text-center">
                            <div class="col-6">
                                <p class="card-text">Engine: 4.0L Turbo</p>
                                <p class="card-text">Year: 2020</p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">Fuel Cons. 12L</p>
                                <p class="card-text">Miles: 15,000</p>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary w-100 mt-3">Lease Now</a>
                        <button class="btn btn-outline-secondary w-100 mt-2 show-more-btn" type="button" data-bs-toggle="collapse" data-bs-target="#details1" aria-expanded="false" aria-controls="details1">Show more</button>
                        <div class="collapse mt-2" id="details1">
                            <p class="card-text">Transmission: Automatic</p>
                            <p class="card-text">Color: Blue</p>
                            <p class="card-text">Seats: 5</p>
                            <button class="btn btn-outline-secondary w-100 mt-2 show-less-btn" type="button" data-bs-toggle="collapse" data-bs-target="#details1" aria-expanded="true" aria-controls="details1">Show Less</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vehicle 2 -->
            <div class="col">
                <div class="card bg-custom text-custom-primary shadow-sm h-100">
                    <img src="{{url('images/2.jpg')}}" class="card-img-top img-fluid" alt="Vehicle 2" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Vehicle 2</h5>
                        <p class="card-text text-success fs-5 font-weight-bold">From $399/month</p>
                        <div class="row text-center">
                            <div class="col-6">
                                <p class="card-text">Engine: 3.0L V6</p>
                                <p class="card-text">Year: 2019</p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">Fuel Cons. 20 MPG</p>
                                <p class="card-text">Miles: 25,000</p>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary w-100 mt-3">Lease Now</a>
                        <button class="btn btn-outline-secondary w-100 mt-2 show-more-btn" type="button" data-bs-toggle="collapse" data-bs-target="#details2" aria-expanded="false" aria-controls="details2">Show more</button>
                        <div class="collapse mt-2" id="details2">
                            <p class="card-text">Transmission: Manual</p>
                            <p class="card-text">Color: Red</p>
                            <p class="card-text">Seats: 4</p>
                            <button class="btn btn-outline-secondary w-100 mt-2 show-less-btn" type="button" data-bs-toggle="collapse" data-bs-target="#details2" aria-expanded="true" aria-controls="details2">Show Less</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vehicle 3 -->
            <div class="col">
                <div class="card bg-custom text-custom-primary shadow-sm h-100">
                    <img src="{{url('images/3.jpg')}}" class="card-img-top img-fluid" alt="Vehicle 3" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Vehicle 3</h5>
                        <p class="card-text text-success fs-5">From $499/month</p>
                        <div class="row text-center">
                            <div class="col-6">
                                <p class="card-text">Engine: 4.0L V8</p>
                                <p class="card-text">Year: 2021</p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">Fuel Cons. 18 MPG</p>
                                <p class="card-text">Miles: 10,000</p>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary w-100 mt-3">Lease Now</a>
                        <button class="btn btn-outline-secondary w-100 mt-2 show-more-btn" type="button" data-bs-toggle="collapse" data-bs-target="#details3" aria-expanded="false" aria-controls="details3">Show more</button>
                        <div class="collapse mt-2" id="details3">
                            <p class="card-text">Transmission: Automatic</p>
                            <p class="card-text">Color: Black</p>
                            <p class="card-text">Seats: 5</p>
                            <button class="btn btn-outline-secondary w-100 mt-2 show-less-btn" type="button" data-bs-toggle="collapse" data-bs-target="#details3" aria-expanded="true" aria-controls="details3">Show Less</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endSection
