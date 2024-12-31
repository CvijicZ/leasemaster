@extends('layouts.admin')

@section('admin-content')
    <div class="container-fluid">
        <h2 class="text-custom-primary mb-4">Vehicle Rentals</h2>

        <!-- Rentals Table -->
        <div class="table-responsive bg-custom-secondary p-3 rounded shadow-sm">
            <table class="table table-striped table-hover">
                <thead class="bg-custom-primary text-custom-secondary">
                    <tr>
                        <th>#</th>
                        <th>Vehicle</th>
                        <th>Customer</th>
                        <th>Rental Start</th>
                        <th>Rental End</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-custom-primary">
                    <tr>
                        <td>1</td>
                        <td>Toyota Camry</td>
                        <td>John Doe</td>
                        <td>2024-12-01</td>
                        <td>2024-12-10</td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-edit"></i> Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>

                            <!-- View Details Button -->
                            <a href="#" class="btn btn-sm btn-info">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Honda Civic</td>
                        <td>Jane Smith</td>
                        <td>2024-12-05</td>
                        <td>2024-12-15</td>
                        <td>
                            <span class="badge bg-secondary">Completed</span>
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-edit"></i> Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>

                            <!-- View Details Button -->
                            <a href="#" class="btn btn-sm btn-info">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>BMW X5</td>
                        <td>Mark Johnson</td>
                        <td>2024-12-10</td>
                        <td>2024-12-20</td>
                        <td>
                            <span class="badge bg-secondary">Completed</span>
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-edit"></i> Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>

                            <!-- View Details Button -->
                            <a href="#" class="btn btn-sm btn-info">
                                <i class="fa-solid fa-eye"></i> Details
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Add Rental Button -->
        <div class="mt-4">
            <a href="#" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Add New Rental
            </a>
        </div>
    </div>
@endsection
