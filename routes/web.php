<?php

use App\Http\Controllers\admin\AttendanceController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\LeaveController;
use App\Http\Controllers\admin\PayrollController;
use App\Http\Controllers\admin\PerformanceController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('app.home'))->name('home');
//landing page routes
Route::get('/about', fn() => view('app.about.about'))->name('about');
Route::get('/contact', fn() => view('app.contact.contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/subscribe', [ContactController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/features', fn() => view('app.pages.features'))->name('features');
Route::get('/solutions', fn() => view('app.pages.solutions'))->name('solutions');
Route::get('/pricing', fn() => view('app.pages.pricing'))->name('pricing');
Route::get('/resources', fn() => view('app.pages.resources'))->name('resources');

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // HR Modules
    Route::middleware('permission:employee.view')
        ->group(function () {
            Route::resource('employees', EmployeeController::class);
        });

    Route::middleware('permission:employee.view')
        ->group(function () {
            Route::resource('departments', DepartmentController::class);
        });

    Route::middleware('permission:attendance.view')
        ->group(function () {
            Route::resource('attendances', AttendanceController::class);
        });

    Route::middleware('permission:leave.view')
        ->group(function () {
            Route::resource('leave', LeaveController::class);
        });

    Route::middleware('permission:payroll.manage')
        ->group(function () {
            Route::resource('payroll', PayrollController::class);
        });

    Route::middleware('permission:employee.view')
        ->group(function () {
            Route::resource('performance', PerformanceController::class);
        });

    Route::middleware('permission:reports.view')
        ->group(function () {
            Route::resource('reports', ReportController::class);
        });
});

// Auth Routes

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//log viewer route
require __DIR__ . '/auth.php';

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
