@extends('layouts.admin')

@section('admin-content')
    <!-- Main Content -->
    <div class="container-fluid">
        <h2 class="text-custom-primary">Users Management</h2>
        <div class="table-responsive bg-custom-secondary p-3 rounded shadow-sm">
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
                            <td>{{ $user->is_admin == true ? 'Admin' : 'User' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-edit"></i> Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>

                                <!-- Role Update Button -->
                                <form action="{{ route('admin.users.updateRole', $user) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-user-shield"></i>
                                        {{ $user->is_admin == true ? 'Remove admin' : 'Promote to admin' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
