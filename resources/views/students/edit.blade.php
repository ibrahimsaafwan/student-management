@extends('layouts.app')

@section('content')
    <!-- Student edit form container -->
    <div class="student-form">
        <div class="card shadow">
            <!-- Card header with warning background -->
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">Edit Student</h4>
            </div>
            <!-- Card body containing the form -->
            <div class="card-body">
                <!-- Form with PUT method for update and file upload support -->
                <form action="{{ route('students.update', $student) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Form layout in two columns (photo left, fields right) -->

                    <div class="row">
                        <!-- Photo Preview with Camera Icon -->
                        <div class="col-md-4 text-center mb-4 position-relative">
                            <!-- Profile image container with hover effect -->
                            <div class="profile-image-container mx-auto">
                                <!-- Current student photo or default image -->
                                <img src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('images/default.png') }}"
                                    alt="Current Photo" class="rounded-circle profile-image">
                                <!-- Hidden file input triggered by camera icon -->
                                <label for="photo" class="camera-icon">
                                    <i class="fas fa-camera"></i>
                                    <input type="file" id="photo" name="photo" class="d-none"
                                        accept="image/jpeg,image/png">
                                </label>
                            </div>
                            <!-- Student name display below photo -->
                            <div class="mt-2">
                                <h3>{{ $student->full_name }}</h3>
                            </div>
                            <!-- Photo upload error message -->
                            @error('photo')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Student information fields -->
                        <div class="col-md-8">
                            <div class="row g-3">
                                <!-- First Name -->
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        id="first_name" name="first_name"
                                        value="{{ old('first_name', $student->first_name) }}">
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        id="last_name" name="last_name" value="{{ old('last_name', $student->last_name) }}">
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Username -->
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" value="{{ old('username', $student->username) }}">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $student->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone', $student->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                        name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male"
                                            {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female"
                                            {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="Other"
                                            {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Course -->
                                <div class="col-md-6">
                                    <label for="course" class="form-label">Course</label>
                                    <select class="form-select @error('course') is-invalid @enderror" id="course"
                                        name="course">
                                        <option value="">Select Course</option>
                                        <option value="PHP"
                                            {{ old('course', $student->course) == 'PHP' ? 'selected' : '' }}>PHP</option>
                                        <option value="Laravel"
                                            {{ old('course', $student->course) == 'Laravel' ? 'selected' : '' }}>Laravel
                                        </option>
                                        <option value="React"
                                            {{ old('course', $student->course) == 'React' ? 'selected' : '' }}>React
                                        </option>
                                        <option value="Vue"
                                            {{ old('course', $student->course) == 'Vue' ? 'selected' : '' }}>Vue</option>
                                    </select>
                                    @error('course')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form action buttons -->
                            <div class="d-flex justify-content-between my-4">
                                <!-- Back button to student list -->
                                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </a>
                                <!-- Submit button to update student -->
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
