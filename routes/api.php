<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('students', StudentController::class);
Route::apiResource('courses', CourseController::class);