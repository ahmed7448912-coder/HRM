<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AttendanceService;

class MarkAbsentEmployees extends Command
{
    protected $signature = 'attendance:mark-absent';
    protected $description = 'Mark absent employees daily';

    public function handle(AttendanceService $service)
    {
        $date = now()->toDateString();

        $service->markAbsentEmployees($date);

        $this->info('Absent employees marked successfully');
    }
}
