<?php

namespace Database\Seeders;

use App\Models\Employees;
use App\Models\Salary;
use App\Models\SalaryTransaction;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employees::all();

        if ($employees->isEmpty()) {
            $this->command->warn('No employees found. Skipping SalarySeeder.');
            return;
        }

        $currentMonth = now()->format('Y-m');

        foreach ($employees->values() as $index => $employee) {
            $isPaid    = ($index === 0);
            $paidAt    = $isPaid ? now()->subDays(3) : null;
            $reference = $isPaid ? 'DEMO_' . strtoupper(uniqid()) : null;

            $salary = Salary::firstOrCreate(
                [
                    'employee_id' => $employee->id,
                    'month'       => $currentMonth,
                ],
                [
                    'amount'            => $employee->salary ?? rand(50000, 150000),
                    'status'            => $isPaid ? 'paid' : 'unpaid',
                    'paid_at'           => $paidAt,
                    'payment_reference' => $reference,
                ]
            );

            // Create a matching transaction for the paid salary
            if ($isPaid) {
                SalaryTransaction::firstOrCreate(
                    ['salary_id' => $salary->id],
                    [
                        'transaction_id' => 'pi_demo_' . strtolower(uniqid()),
                        'amount'         => $salary->amount,
                        'currency'       => 'usd',
                        'payment_method' => 'stripe',
                        'status'         => 'success',
                        'email_sent_to'  => $employee->email ?? null,
                        'email_sent_at'  => now()->subDays(3),
                        'stripe_response' => [
                            'id'     => 'pi_demo_example',
                            'status' => 'succeeded',
                            'amount' => (int)($salary->amount * 100),
                        ],
                    ]
                );
            }
        }

        $this->command->info('SalarySeeder: ' . $employees->count() . ' records created for ' . $currentMonth . '.');
    }
}
