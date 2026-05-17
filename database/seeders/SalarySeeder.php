<?php

namespace Database\Seeders;

use App\Models\Employees;
use App\Models\Salary;
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

        $months = [
            now()->subMonths(2)->format('Y-m'),
            now()->subMonth()->format('Y-m'),
            now()->format('Y-m'),
        ];

        foreach ($employees as $employee) {
            foreach ($months as $month) {
                Salary::firstOrCreate(
                    [
                        'employee_id' => $employee->id,
                        'month'       => $month,
                    ],
                    [
                        'amount' => $employee->salary ?? rand(50000, 150000),
                        'status' => 'unpaid',
                    ]
                );
            }
        }

        $this->command->info('SalarySeeder: salary records created successfully.');
    }
}
