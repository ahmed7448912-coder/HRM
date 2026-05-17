<?php

namespace App\Providers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Observers\AttendanceObserver;
use App\Observers\LeaveObserver;
use App\Repositories\SalaryRepository;
use App\Services\SalaryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SalaryRepository::class);
        $this->app->bind(SalaryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Attendance::observe(AttendanceObserver::class);
        Leave::observe(LeaveObserver::class);
    }
}
