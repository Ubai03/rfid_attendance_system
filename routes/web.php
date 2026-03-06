<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Models\Attendance;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//------------- Students page routes ------------------
Route::get('/students', [StudentController::class, 'index'])->name('students');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
//-----------------------------------------------------

//------------- Attendance page routes ----------------
Route::get('/dashboard', function () {
    $date = request('date', now()->toDateString());
    $attendance = Attendance::with('student')
        ->whereDate('date', $date)->get();
    return view('dashboard', compact('attendance'));
})->middleware(['auth', 'verified'])->name('dashboard');
//-----------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
