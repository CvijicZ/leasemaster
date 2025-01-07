@extends('layouts.app')

@section('content')
    <div class="container-fluid min-vh-100">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-3 bg-custom-primary admin-sidebar">
                <h3 class="text-custom-secondary">Admin Panel</h3>
                <ul class="nav flex-column text-start ps-3">
                    <li class="nav-item">
                        <a class="nav-link text-custom-primary {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-chart-simple"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-custom-primary {{ request()->is('admin/users') ? 'active' : '' }}"
                            href="{{ route('admin.users') }}">
                            <i class="fa-solid fa-users-gear"></i> Manage Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-custom-primary {{ request()->is('admin/rentals') ? 'active' : '' }}"
                            href="{{ route('admin.rentals') }}">
                            <i class="fa-solid fa-car"></i> Vehicle Rentals
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-custom-primary {{ request()->is('admin/vehicles/create') ? 'active' : '' }}"
                            href="{{route('vehicles.create')}}">
                            <i class="fa-solid fa-car"> +</i> Create vehicle
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-custom-primary {{ request()->is('admin/settings') ? 'active' : '' }}"
                            href="{{ route('admin.settings') }}">
                            <i class="fa-solid fa-gears"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">
                @yield('admin-content')
            </div>
        </div>
    </div>
@endsection
