@extends('layouts.app')

@section('content')
    <!-- Student details container -->
    <div class="student-details">
        <!-- Card with shadow effect -->
        <div class="card shadow">
            <!-- Card header with info background -->
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Student Details</h4>
            </div>
            <!-- Card body containing student information -->
            <div class="card-body">
                <!-- Two-column layout (photo left, details right) -->
                <div class="row">
                    <!-- Student photo section -->
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <!-- Display student photo or default image -->
                        <img src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('images/default.png') }}"
                            alt="Profile Photo" class="img-thumbnail mb-3 shadow" style="max-width: 200px;">
                        <!-- Student full name display -->
                        <div class="mt-2">
                            <h3>{{ $student->full_name }}</h3>
                        </div>
                    </div>

                    <!-- Student information section -->
                    <div class="col-md-8">
                        <!-- Grid layout for student details -->
                        <div class="row g-3">
                            <!-- Full name field -->
                            <div class="col-md-6">
                                <h5>Full Name</h5>
                                <p class="text-muted">{{ $student->full_name }}</p>
                            </div>

                            <!-- Username field -->
                            <div class="col-md-6">
                                <h5>Username</h5>
                                <p class="text-muted">{{ $student->username }}</p>
                            </div>

                            <!-- Email field -->
                            <div class="col-md-6">
                                <h5>Email</h5>
                                <p class="text-muted">{{ $student->email }}</p>
                            </div>

                            <!-- Phone field -->
                            <div class="col-md-6">
                                <h5>Phone</h5>
                                <p class="text-muted">{{ $student->phone }}</p>
                            </div>

                            <!-- Gender field -->
                            <div class="col-md-6">
                                <h5>Gender</h5>
                                <p class="text-muted">{{ $student->gender }}</p>
                            </div>

                            <!-- Course field -->
                            <div class="col-md-6">
                                <h5>Course</h5>
                                <p class="text-muted">{{ $student->course }}</p>
                            </div>
                        </div>

                        <!-- Action buttons -->
                        <div class="d-flex gap-2 my-4">
                            <!-- Edit button linking to edit form -->
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                            <!-- Back button to student list -->
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
