<?php

namespace App\Console\Commands;

use App\Models\Employees;
use App\Services\PayrollService;
use Illuminate\Console\Command;

class GeneratePayrollCommand extends Command
{

    protected $signature = 'payroll:monthly';

    public function handle(PayrollService $service)
    {
        $employees = Employees::all();

        foreach ($employees as $emp) {
            $service->processPayroll($emp->id, now());
        }

        $this->info('Payroll processed & emails sent');
    }
}
