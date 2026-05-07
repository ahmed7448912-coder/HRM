<?php

namespace App\Services;

use App\Jobs\SendPayrollMailJob;

use App\Models\Attendance;
use App\Models\Employees;
use App\Models\Leave;
use App\Models\Payroll;

class PayrollService
{
    public function calculateForEmployee($employeeId, $month)
    {
        $employee = Employees::findOrFail($employeeId);

        $monthStart = date('Y-m-01', strtotime($month));
        $monthEnd = date('Y-m-t', strtotime($month));

        // attendance
        $absents = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$monthStart, $monthEnd])
            ->where('status', 'absent')
            ->count();

        // leaves
        $leaves = Leave::where('employee_id', $employeeId)
            ->where('status', 'approved')
            ->whereBetween('from_date', [$monthStart, $monthEnd])
            ->count();

        // basic logic
        $deductionPerDay = 500;
        $bonus = 0;

        $deductions = ($absents * $deductionPerDay);

        $netSalary = $employee->salary - $deductions + $bonus;

        return [
            'employee_id' => $employeeId,
            'month' => $monthStart,
            'basic_salary' => $employee->salary,
            'absents' => $absents,
            'leaves' => $leaves,
            'deductions' => $deductions,
            'bonus' => $bonus,
            'net_salary' => $netSalary,
        ];
    }
    //generate payroll
    public function processPayroll($employeeId, $month)
    {
        $data = $this->calculateForEmployee($employeeId, $month);

        $payroll = Payroll::updateOrCreate(
            [
                'employee_id' => $employeeId,
                'month' => $data['month']
            ],
            $data
        );

        //  dispatch email job
        dispatch(new SendPayrollMailJob($payroll));

        return $payroll;
    }
}
