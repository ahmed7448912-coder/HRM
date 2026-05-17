<?php

namespace App\Mail;

use App\Models\Salary;
use App\Models\SalaryTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SalaryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Salary            $salary,
        public readonly SalaryTransaction $transaction
    ) {}

    public function build(): self
    {
        return $this
            ->subject('Salary Receipt — ' . $this->salary->month)
            ->view('emails.salary-receipt');
    }
}
