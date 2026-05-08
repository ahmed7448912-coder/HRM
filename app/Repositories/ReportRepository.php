<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Leave;

class ReportRepository
{
    public function attendanceReport($filters = [])
    {
        $query = Attendance::with('employee');

        if (!empty($filters['employee_id'])) {
            $query->where('employee_id', $filters['employee_id']);
        }

        if (!empty($filters['from_date'])) {
            $query->whereDate('date', '>=', $filters['from_date']);
        }

        if (!empty($filters['to_date'])) {
            $query->whereDate('date', '<=', $filters['to_date']);
        }

        return $query->latest();
    }

    public function payrollReport($filters = [])
    {
        $query = Payroll::with('employee');

        if (!empty($filters['employee_id'])) {
            $query->where('employee_id', $filters['employee_id']);
        }

        return $query->latest();
    }

    public function leaveReport($filters = [])
    {
        $query = Leave::with('employee');

        if (!empty($filters['employee_id'])) {
            $query->where('employee_id', $filters['employee_id']);
        }

        return $query->latest();
    }
}
