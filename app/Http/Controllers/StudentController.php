<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Laravel\Facades\Image;

class StudentController extends Controller
{
    // Display paginated students list (5 per page)

    public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('students.index', compact('students'));
    }

    // Show student creation form

    public function create()
    {
        return view('students.create');
    }

    // Validate input, process image upload, and create a new student record

    public function store(StudentRequest $request)

    {
        // Validate request data

        $data = $request->validated();

        // Check if an image file is uploaded

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            // Process image with Intervention Image

            $image = Image::read($file)
                ->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode(new WebpEncoder(quality: 90)); // Convert to WebP format

            // Generate a unique filename

            $fileName = uniqid() . '.webp';
            $path = 'uploads/' . $fileName;

            // Store the processed image in public storage

            Storage::disk('public')->put($path, $image);

            // Save the image path in the database

            $data['photo'] = $path;
        }

        // Create a new student record

        Student::create($data);

        return redirect()->route('students.index')->with('status', 'Student Created Successfully!');
    }

    // Display the details of a single student

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Show the student edit form

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update student details, replace photo if a new one is uploaded & keep existing if no new upload

    public function update(StudentRequest $request, Student $student)
    {
        // Validate request data

        $data = $request->validated();

        // Check if a new photo is uploaded

        if ($request->hasFile('photo')) {

            // Delete the old photo if it exists

            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }

            $file = $request->file('photo');

            // Process new image with Intervention Image

            $image = Image::read($file)
                ->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode(new WebpEncoder(quality: 90));

            // Generate a unique filename

            $fileName = uniqid() . '.webp';
            $path = 'uploads/' . $fileName;

            // Store the new image in public storage

            Storage::disk('public')->put($path, $image);

            // Save the new image path in the database

            $data['photo'] = $path;
        } else {

            // Keep the existing photo if no new file is uploaded

            $data['photo'] = $student->photo;
        }

        // Update the student record

        $student->update($data);

        return redirect()->route('students.index')->with('status', 'Student Updated Successfully!');
    }


    // Delete student record along with associated photo file

    public function destroy(Student $student)
    {
        // Remove the photo from storage if it exists

        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }

        // Delete the student record from the database

        $student->delete();

        return redirect()->route('students.index')->with('status', 'Student Deleted Successfully!');
    }
}
