@extends('layouts.admin')

@section('admin-content')
    <h2 class="text-custom-primary">Admin Dashboard</h2>
    <div class="row g-4">
        <!-- Statistic Cards -->
        <div class="col-md-4">
            <div class="card bg-custom-secondary text-custom-primary shadow-sm">
                <div class="card-body text-center">
                    <h4><i class="fa-solid fa-users"></i> Users</h4>
                    <p class="fs-2 fw-bold">123</p>
                    <small>Total Registered Users</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-custom-secondary text-custom-primary shadow-sm">
                <div class="card-body text-center">
                    <h4><i class="fa-solid fa-car"></i> Rentals</h4>
                    <p class="fs-2 fw-bold">456</p>
                    <small>Active Rentals</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-custom-secondary text-custom-primary shadow-sm">
                <div class="card-body text-center">
                    <h4><i class="fa-solid fa-coins"></i> Revenue</h4>
                    <p class="fs-2 fw-bold">$78,910</p>
                    <small>This Month</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <!-- Chart 1 -->
        <div class="col-md-6">
            <div class="card bg-custom-secondary text-custom-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-chart-pie"></i> User Account Types</h5>
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Chart 2 -->
        <div class="col-md-6">
            <div class="card bg-custom-secondary text-custom-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-chart-line"></i> Vehicle Rentals</h5>
                    <canvas id="rentalChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
