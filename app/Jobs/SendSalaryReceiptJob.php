<?php

namespace App\Jobs;

use App\Mail\SalaryMail;
use App\Models\Salary;
use App\Models\SalaryTransaction;
use App\Repositories\SalaryRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendSalaryReceiptJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;
    public int $backoff = 30;

    public function __construct(
        public readonly Salary            $salary,
        public readonly SalaryTransaction $transaction
    ) {}

    public function handle(SalaryRepository $repo): void
    {
        $email = $this->salary->employee->email ?? null;

        if (! $email) {
            Log::warning("SendSalaryReceiptJob: employee #{$this->salary->employee_id} has no email.");
            return;
        }

        Mail::to($email)->send(new SalaryMail($this->salary, $this->transaction));

        $repo->updateTransactionEmail($this->transaction);

        Log::info("Salary receipt sent to {$email} for salary #{$this->salary->id}.");
    }

    public function failed(\Throwable $e): void
    {
        Log::error("SendSalaryReceiptJob failed for salary #{$this->salary->id}", [
            'error'   => $e->getMessage(),
            'attempt' => $this->attempts(),
        ]);
    }
}
