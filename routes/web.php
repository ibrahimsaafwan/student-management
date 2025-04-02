<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

// Resourceful routes for students (index, create, store, show, edit, update, destroy)

Route::resource('students', StudentController::class);
