@extends('layouts.app')

@section('content')
    <div class="student-management">
        <!-- Display flash message if exists -->
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Student List</h2>
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add Student
            </a>
        </div>
        <!-- Main card containing student table -->
        <div class="card shadow">
            <div class="card-body">
                <!-- Responsive table container -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <!-- Table header -->
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Course</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <!-- Table body with student data -->
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <!-- Student profile image -->
                                    <td>
                                        <img src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('images/default.png') }}"
                                            alt="Profile" class="rounded-circle" width="40" height="40">
                                    </td>
                                    <!-- Student full name -->
                                    <td>{{ $student->full_name }}</td>
                                    <!-- Student phone number -->
                                    <td>{{ $student->phone }}</td>
                                    <!-- Student email -->
                                    <td>{{ $student->email }}</td>
                                    <!-- Student gender -->
                                    <td>{{ $student->gender }}</td>
                                    <!-- Student course -->
                                    <td>{{ $student->course }}</td>
                                    <!-- Action buttons (View, Edit, Delete) -->
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- View button -->
                                            <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info"
                                                title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <!-- Edit button -->
                                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- Delete button with data attribute -->
                                            <button class="btn btn-sm btn-danger delete-btn"
                                                data-student-id="{{ $student->id }}" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination links -->
                <div>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal body with confirmation message -->
                <div class="modal-body">
                    Are you sure you want to delete this student's information?
                </div>
                <!-- Modal footer with action buttons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <!-- Delete form (dynamically populated via JavaScript) -->
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
