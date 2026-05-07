<?php

namespace App\Jobs;

use App\Mail\PayrollMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendPayrollMailJob implements ShouldQueue
{
    use Queueable;

    public $payroll;

    public function __construct($payroll)
    {
        $this->payroll = $payroll;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->payroll->employee->email)
            ->send(new PayrollMail($this->payroll));
    }
}
