<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    //Determine if the user is authorized to make this request.

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username'   => ['required', 'string', 'max:20', 'regex:/^[a-zA-Z0-9]+$/', Rule::unique('students', 'username')->ignore($this->student)],
            'first_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s-]+$/'],
            'last_name'  => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s-]+$/'],
            'phone'      => ['required', 'digits:11', Rule::unique('students', 'phone')->ignore($this->student)],
            'email'      => ['required', 'email', 'max:100', Rule::unique('students', 'email')->ignore($this->student)],
            'gender'     => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'course'     => ['required', Rule::in(['PHP', 'Laravel', 'React', 'Vue'])],
            'photo'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    // Custom error messages for validation rules

    public function messages(): array
    {
        return [
            'username.required'   => 'Username is required!',
            'username.max'        => 'Username cannot be longer than 20 characters!',
            'username.regex'      => 'Username can only contain letters and numbers!',
            'username.unique'     => 'This username is already taken!',

            'first_name.required' => 'First name is required!',
            'first_name.max'      => 'First name cannot exceed 50 characters!',
            'first_name.regex'    => 'First name can only contain letters, spaces, and hyphens!',

            'last_name.required'  => 'Last name is required!',
            'last_name.max'       => 'Last name cannot exceed 50 characters!',
            'last_name.regex'     => 'Last name can only contain letters, spaces, and hyphens!',

            'phone.required'      => 'Phone number is required!',
            'phone.digits'        => 'Phone number must be exactly 11 digits!',
            'phone.unique'        => 'This phone number is already in use!',

            'email.required'      => 'Email address is required!',
            'email.email'         => 'Please enter a valid email address!',
            'email.max'           => 'Email cannot exceed 100 characters!',
            'email.unique'        => 'This email is already in use!',

            'gender.required'     => 'Please select a gender!',
            'gender.in'           => 'Invalid gender selection!',

            'course.required'     => 'Please select a course!',
            'course.in'           => 'Invalid course selection!',

            'photo.image'         => 'Uploaded file must be an image!',
            'photo.mimes'         => 'Only JPG, JPEG, PNG and WEBP formats are allowed!',
            'photo.max'           => 'Image size must not exceed 2MB!',
        ];
    }

    // Custom attribute names for form fields

    public function attributes(): array
    {
        return [
            'username'   => 'Username',
            'first_name' => 'First Name',
            'last_name'  => 'Last Name',
            'phone'      => 'Phone Number',
            'email'      => 'Email Address',
            'gender'     => 'Gender',
            'course'     => 'Course',
            'photo'      => 'Profile Picture',
        ];
    }
}
