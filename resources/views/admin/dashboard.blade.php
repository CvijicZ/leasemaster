@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-custom text-custom-primary min-vh-100">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-3 bg-custom-secondary">
                <h3 class="text-center">Admin Panel</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link custom-link-color" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link-color" href="#">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link-color" href="#">Settings</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">
                <h2 class="text-custom-primary">Users Management</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-custom-secondary text-custom-primary">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                            class="btn btn-sm btn-primary">Edit</a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
