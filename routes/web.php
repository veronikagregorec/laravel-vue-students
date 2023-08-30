<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/example', function () {
//     return view('example');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-student', [StudentController::class, 'create']);
Route::post('/save-student', [StudentController::class, 'store']);
Route::get('/students', [StudentController::class, 'index']);
Route::post('/get-studentsdata', [StudentController::class, 'fetchStudentData']);
Route::get('/edit-student/{id}/edit', [StudentController::class, 'edit']);
Route::get('/fetch-student-showbyid/{id}', [StudentController::class, 'editData']);
Route::put('/update-student/{id}', [StudentController::class, 'update']);
Route::delete('/delete-student/{id}', [StudentController::class, 'delete']);
