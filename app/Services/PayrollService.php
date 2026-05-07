<?php

namespace App\Services;

use App\Jobs\SendPayrollMailJob;
use App\Models\Attendance;
use App\Models\Employees;
use App\Models\Leave;
use App\Models\Payroll;
use Yajra\DataTables\Facades\DataTables;

class PayrollService
{
    public function getDatatable()
    {
        $payrolls = Payroll::with('employee')->select('payrolls.*');

        return DataTables::of($payrolls)
            ->addIndexColumn()
            ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
            ->addColumn('month', fn($row) => date('F Y', strtotime($row->month)))
            ->addColumn('actions', 'admin.payroll._actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

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

    public function generateAll($month)
    {
        $employees = Employees::all();
        foreach ($employees as $emp) {
            $this->processPayroll($emp->id, $month);
        }
    }

    public function update(Payroll $payroll, array $data)
    {
        $net_salary = $data['basic_salary'] - $data['deductions'] + $data['bonus'];
        $data['net_salary'] = $net_salary;

        return $payroll->update($data);
    }
}
