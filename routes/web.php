<?php

use App\Http\Controllers\admin\AttendanceController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\LeaveController;
use App\Http\Controllers\admin\PayrollController;
use App\Http\Controllers\admin\PerformanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));
// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

    // HR Modules
    Route::resource('employees', EmployeeController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('leave', LeaveController::class);
    Route::resource('payroll', PayrollController::class);
    Route::resource('performance', PerformanceController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
