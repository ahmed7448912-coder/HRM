<?php


namespace App\Jobs;

use App\Models\Salary;
use App\Services\SalaryService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessSalaryPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * How many times to retry if the job fails.
     * Stripe is idempotent-safe so retrying is fine.
     */
    public int $tries = 3;

    /**
     * Wait 60s before retrying to avoid hammering Stripe.
     */
    public int $backoff = 60;

    /**
     * Mark salary as "processing" and lock it so no duplicate
     * job can fire while this one is in the queue.
     */
    public function __construct(
        public readonly Salary $salary,
        public readonly string $paymentMethodId
    ) {}

    public function handle(SalaryService $salaryService): void
    {
        // Guard: skip if already paid (handles duplicate dispatches)
        if ($this->salary->fresh()->status === 'paid') {
            Log::info("ProcessSalaryPaymentJob skipped — salary #{$this->salary->id} already paid.");
            return;
        }

        $transaction = $salaryService->processSalaryPayment(
            $this->salary,
            $this->paymentMethodId
        );

        // Chain the email job immediately after payment succeeds
        SendSalaryReceiptJob::dispatch($this->salary->fresh(), $transaction);
    }

    public function failed(\Throwable $e): void
    {
        Log::error("ProcessSalaryPaymentJob failed for salary #{$this->salary->id}", [
            'error'   => $e->getMessage(),
            'salary'  => $this->salary->id,
            'attempt' => $this->attempts(),
        ]);

        // Optionally notify HR that payment failed
        // Notification::route('mail', config('hrm.hr_email'))
        //     ->notify(new SalaryPaymentFailedNotification($this->salary, $e));
    }
}
