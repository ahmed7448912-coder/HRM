<?php

use App\Http\Controllers\admin\AttendanceController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\LeaveController;
use App\Http\Controllers\admin\PayrollController;
use App\Http\Controllers\admin\PerformanceController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\ApprovalController;
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

// User Approval Status Routes
Route::middleware('auth')->group(function () {
    Route::get('/approval/pending', fn() => view('approval.pending'))->name('approval.pending');
    Route::get('/approval/rejected', fn() => view('approval.rejected'))->name('approval.rejected');
});

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // User Approvals (Admin Only)
    Route::middleware('role:Admin')->group(function () {
        Route::get('/approvals', [ApprovalController::class, 'index'])->name('admin.approvals.index');
        Route::post('/approvals/{user}/approve', [ApprovalController::class, 'approve'])->name('admin.approvals.approve');
        Route::post('/approvals/{user}/reject', [ApprovalController::class, 'reject'])->name('admin.approvals.reject');
    });

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
    Route::middleware(['auth', 'role:Admin'])
        ->group(function () {
            Route::resource('roles', RoleController::class);
        });
    Route::middleware(['auth', 'permission:salary.view'])
        ->group(function () {
            Route::get('salary/transactions', [SalaryController::class, 'transactions'])->name('salary.transactions');
            Route::delete('salary/transactions/{transaction}', [SalaryController::class, 'destroyTransaction'])->name('salary.transactions.destroy');
            Route::get('salary/{salary}/pay', [SalaryController::class, 'pay'])->name('salary.pay');
            Route::post('salary/{salary}/process', [SalaryController::class, 'process'])->name('salary.process');
            Route::post('salary/{salary}/confirm-payment', [SalaryController::class, 'confirmPayment'])->name('salary.confirm-payment');
            Route::post('salary/{salary}/resend-email', [SalaryController::class, 'resendEmail'])->name('salary.resend-email');
            Route::post('salary/{salary}/cancel', [SalaryController::class, 'cancel'])->name('salary.cancel');
            Route::resource('salary', SalaryController::class);
        });
});

// Auth Routes

Route::get('/auth/google', [SocialAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class, 'callback'])->name('google.callback');
Route::get('/auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//log viewer route
require __DIR__ . '/auth.php';

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
