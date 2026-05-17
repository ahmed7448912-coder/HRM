<?php

namespace App\Services;

use App\Models\Salary;
use App\Models\SalaryTransaction;
use App\Jobs\SendSalaryReceiptJob;
use App\Repositories\SalaryRepository;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class SalaryService
{
    public function __construct(
        protected SalaryRepository $repo
    ) {}

    public function processSalaryPayment(Salary $salary, string $paymentMethodId): SalaryTransaction
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount'              => (int) ($salary->amount * 100),
            'currency'            => 'usd',
            'payment_method'      => $paymentMethodId,
            'confirmation_method' => 'manual',
            'confirm'             => true,
            'description'         => "Salary: {$salary->employee->name} — {$salary->month}",
            'receipt_email'       => $salary->employee->email ?? null,
            'metadata'            => [
                'employee_id' => $salary->employee_id,
                'salary_id'   => $salary->id,
                'month'       => $salary->month,
            ],
            'return_url' => route('salary.index'),
        ]);

        $transaction = $this->repo->saveTransaction([
            'salary_id'       => $salary->id,
            'transaction_id'  => $intent->id,
            'amount'          => $salary->amount,
            'currency'        => 'usd',
            'payment_method'  => 'stripe',
            'status'          => $intent->status === 'succeeded' ? 'success' : 'failed',
            'stripe_response' => $intent->toArray(),
            'email_sent_to'   => $salary->employee->email ?? null,
        ]);

        $this->repo->markAsPaid($salary, $intent->id);

        // Email is now handled by SendSalaryReceiptJob — not here
        return $transaction;
    }

    public function resendReceiptEmail(Salary $salary): void
    {
        if ($salary->status !== 'paid') {
            throw new \Exception('Salary has not been paid yet.');
        }

        $transaction = $this->repo->getLastTransaction($salary);

        if (! $transaction) {
            throw new \Exception('No transaction record found.');
        }

        if (! $salary->employee->email) {
            throw new \Exception('Employee has no email address on file.');
        }

        // Dispatch the email job instead of sending inline
        SendSalaryReceiptJob::dispatch($salary, $transaction);
    }
}
