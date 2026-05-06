<?php

namespace App\Jobs;

use App\Models\Employee;
use App\Mail\EmployeeWelcomeMail;
use App\Models\Employees;
use Illuminate\Support\Facades\Mail;

class SendEmployeeWelcomeMailJob
{
    public $employee;

    public function __construct(Employees $employee)
    {
        $this->employee = $employee;
    }

    public function handle(): void
    {
        Mail::to($this->employee->email)
            ->send(new EmployeeWelcomeMail($this->employee));
    }
}
