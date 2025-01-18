@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User: {{ $user->name }}</h1>

        <!-- Display validation errors at the top of the form -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display current profile image -->
        <div class="mb-4 text-center">
            <img src="{{ $user->profilePicture ? asset('storage/' . $user->profilePicture) : asset('images/placeholder.png') }}" 
                 alt="Profile Image" 
                 class="rounded-circle" 
                 style="width: 150px; height: 150px; object-fit: cover;">
        </div>

        <!-- Form to update user details -->
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name field -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email field -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password field (optional) -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Leave blank to keep current password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password field -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="password_confirmation" name="password_confirmation">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>

        <!-- Upload profile image form -->
        <form action="{{route('user.set.profile.picture', $user->id)}}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" class="form-control-file @error('profile_image') is-invalid @enderror" id="profile_image"
                    name="profile_image">
                @error('profile_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-secondary">Upload Image</button>
        </form>
    </div>
@endsection
