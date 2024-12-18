@extends('layouts.app')

@section('title', 'Auth')

@section('content')

    <div class="container d-flex align-items-center justify-content-center min-vh-100 bg-custom-secondary"
        data-section={{ $section }}>
        <div class="card shadow-lg w-100 bg-custom text-custom-secondary" style="max-width: 400px;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Welcome Back</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <ul class="nav nav-tabs justify-content-center mb-4" id="authTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('auth.show', ['section' => 'login']) }}"
                            class="nav-link text-custom-link-color {{ $section === 'login' ? 'active' : '' }}"
                            id="login-tab" role="tab" aria-controls="login"
                            aria-selected="{{ $section === 'login' ? 'true' : 'false' }}">
                            Login
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('auth.show', ['section' => 'register']) }}"
                            class="nav-link text-custom-link-color {{ $section === 'register' ? 'active' : '' }}"
                            id="register-tab" role="tab" aria-controls="register"
                            aria-selected="{{ $section === 'register' ? 'true' : 'false' }}">
                            Register
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Login Form -->
                    <div class="tab-pane fade {{ $section === 'login' ? 'show active' : '' }}" id="login"
                        role="tabpanel" aria-labelledby="login-tab">
                        <form>
                            <div class="mb-3">
                                <label for="login-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="login-email" placeholder="Enter your email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="login-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="login-password"
                                    placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>

                    <!-- Register Form -->
                    <div class="tab-pane fade {{ $section === 'register' ? 'show active' : '' }}" id="register"
                        role="tabpanel" aria-labelledby="register-tab">
                        <form method="POST" action="{{ route('auth.store') }}">
                            <div class="mb-3">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror
                                <label for="register-name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="register-name" name="name"
                                    placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span> <br>
                                @enderror
                                <label for="register-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="register-email" name="email"
                                    placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3 position-relative">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror
                                <label for="register-password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Create a password" required>
                                    <button type="button" class="btn btn-outline-secondary" id="toggle-password"
                                        aria-label="Toggle password visibility">
                                        <i class="bi bi-eye" id="toggle-password-icon"></i>
                                    </button>
                                </div>
                                <div class="mb-3 position-relative">
                                    @error('confirm-password')
                                        <span class="text-danger">{{ $message }}</span><br>
                                    @enderror

                                    <label for="confirm-password" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm-password"
                                            name="password_confirmation" placeholder="Confirm your password" required>
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="toggle-confirm-password" aria-label="Toggle password visibility">
                                            <i class="bi bi-eye" id="toggle-confirm-password-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {

                        function toggleVisibility(inputSelector, iconSelector) {
                            const input = $(inputSelector);
                            const icon = $(iconSelector);

                            if (input.attr('type') === 'password') {
                                input.attr('type', 'text');
                                icon.removeClass('bi-eye').addClass('bi-eye-slash');
                            } else {
                                input.attr('type', 'password');
                                icon.removeClass('bi-eye-slash').addClass('bi-eye');
                            }
                        }

                        $('#toggle-password').on('click', function() {
                            toggleVisibility('#register-password', '#toggle-password-icon');
                        });

                        $('#toggle-confirm-password').on('click', function() {
                            toggleVisibility('#confirm-password', '#toggle-confirm-password-icon');
                        });
                    });
                </script>
            @endsection
