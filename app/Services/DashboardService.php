<?php

namespace App\Services;

use App\Models\Employees;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Payroll;
use App\Models\Performance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardService
{
    public function getDashboardStats($period = 'today', $sort = 'newest')
    {
        $dateRange = $this->getDateRange($period);
        $totalEmployees = Employees::count();

        return [
            'totalEmployees' => $totalEmployees,
            'totalDepartments' => Department::count(),
            'pendingLeaves' => Leave::where('status', 'pending')->count(),
            'totalPayroll' => Payroll::whereMonth('month', now()->month)->sum('net_salary'),
            'recentActivity' => $this->getRecentActivity(),
            'deptDistribution' => $this->getDeptDistribution(),
            'sparklines' => $this->getSparklineData(),
            'attendanceTrends' => $this->getAttendanceTrends(),
            'payrollTrends' => $this->getPayrollTrends(),
            'internalVacancies' => $this->getInternalVacancies($sort), // Updated to use project data
            'staffingLevels' => $this->getStaffingLevels(),
            'featuredDepartments' => Department::withCount('employees')->limit(8)->get(),
            'moduleProgress' => $this->getModuleProgress($totalEmployees),
            'totalPayrollExpense' => Payroll::sum('net_salary'),
        ];
    }

    private function getAttendanceTrends()
    {
        $months = collect();
        $labels = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months->push($date->format('Y-m'));
            $labels->push($date->format('M'));
        }

        $attendanceData = Attendance::where('date', '>=', now()->subMonths(6)->startOfMonth())
            ->where('status', 'present')
            ->select(DB::raw("DATE_FORMAT(date, '%Y-%m') as month_year"), DB::raw('count(*) as count'))
            ->groupBy('month_year')
            ->pluck('count', 'month_year');

        $leaveData = Leave::where('from_date', '>=', now()->subMonths(6)->startOfMonth())
            ->where('status', 'approved')
            ->select(DB::raw("DATE_FORMAT(from_date, '%Y-%m') as month_year"), DB::raw('count(*) as count'))
            ->groupBy('month_year')
            ->pluck('count', 'month_year');

        $absentData = Attendance::where('date', '>=', now()->subMonths(6)->startOfMonth())
            ->where('status', 'absent')
            ->select(DB::raw("DATE_FORMAT(date, '%Y-%m') as month_year"), DB::raw('count(*) as count'))
            ->groupBy('month_year')
            ->pluck('count', 'month_year');

        return [
            'labels' => $labels->values(),
            'present' => $months->map(fn($m) => $attendanceData[$m] ?? 0)->values(),
            'leaves' => $months->map(fn($m) => $leaveData[$m] ?? 0)->values(),
            'absent' => $months->map(fn($m) => $absentData[$m] ?? 0)->values(),
        ];
    }

    private function getPayrollTrends()
    {
        $months = collect();
        $dateLabels = collect();
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months->push($date->format('Y-m'));
            $dateLabels->push($date->format('M'));
        }

        $payrollData = Payroll::where('month', '>=', now()->subMonths(12)->startOfMonth())
            ->select(DB::raw("DATE_FORMAT(month, '%Y-%m') as month_year"), DB::raw('sum(net_salary) as total'))
            ->groupBy('month_year')
            ->pluck('total', 'month_year');

        return [
            'labels' => $dateLabels->values(),
            'data' => $months->map(fn($m) => (float)($payrollData[$m] ?? 0))->values()
        ];
    }

    private function getModuleProgress($totalEmployees)
    {
        if ($totalEmployees == 0) return ['payroll' => 0, 'evaluation' => 0, 'attendance' => 0];

        $paidCount = Payroll::whereMonth('month', now()->month)->distinct('employee_id')->count();
        $payrollProg = round(($paidCount / $totalEmployees) * 100);

        $presentToday = Attendance::where('date', now()->format('Y-m-d'))
            ->where('status', 'present')
            ->count();
        $attendanceProg = round(($presentToday / $totalEmployees) * 100);

        $avgRating = Performance::avg('rating') ?: 0;
        $evalProg = round($avgRating * 20);

        return [
            'payroll' => $payrollProg,
            'evaluation' => $evalProg,
            'attendance' => $attendanceProg
        ];
    }

    private function getRecentActivity()
    {
        $attendances = Attendance::with('employee.department')
            ->latest()
            ->limit(3)
            ->get()
            ->map(function ($item) {
                return [
                    'title' => ($item->employee->name ?? 'User') . ' marked presence',
                    'time' => $item->created_at,
                    'icon' => 'bi-person-check',
                    'color' => 'bg-primary'
                ];
            });

        $leaves = Leave::with('employee.department')
            ->latest()
            ->limit(2)
            ->get()
            ->map(function ($item) {
                return [
                    'title' => ($item->employee->name ?? 'User') . ' requested ' . $item->type,
                    'time' => $item->created_at,
                    'icon' => 'bi-calendar-event',
                    'color' => 'bg-warning'
                ];
            });

        return $attendances->concat($leaves)->sortByDesc('time')->values();
    }

    private function getInternalVacancies($sort)
    {
        $depts = Department::limit(4)->get();
        $roles = ['Senior HR Specialist', 'Recruitment Manager', 'Payroll Administrator', 'IT Support Engineer', 'Operations Lead', 'Financial Analyst'];
        
        $vacancies = [];
        foreach ($depts as $index => $dept) {
            // Calculate a realistic salary based on the average basic salary of the department
            $avgDeptSalary = Payroll::whereHas('employee', function($q) use ($dept) {
                $q->where('department_id', $dept->id);
            })->avg('basic_salary') ?: 45000; // Default to 45k if no data

            $minSalary = round($avgDeptSalary * 0.9, -3);
            $maxSalary = round($avgDeptSalary * 1.2, -3);

            $vacancies[] = [
                'id' => $dept->id,
                'title' => $roles[$index % count($roles)],
                'dept' => $dept->name,
                'location' => 'Toba Tek Singh, Pakistan',
                'salary' => 'Rs.' . number_format($minSalary) . ' - Rs.' . number_format($maxSalary), // Using PKR for Toba Tek Singh
                'color' => ['#0d6efd', '#d63384', '#198754', '#fd7e14'][$index % 4],
                'created_at' => now()->subDays($index) 
            ];
        }

        $collection = collect($vacancies);
        return $sort == 'oldest' ? $collection->sortBy('created_at')->values() : $collection->sortByDesc('created_at')->values();
    }

    private function getStaffingLevels()
    {
        return Department::withCount('employees')->limit(4)->get()->map(function($dept) {
            $capacity = 50; 
            $percentage = min(100, round(($dept->employees_count / $capacity) * 100));
            return [
                'role' => $dept->name,
                'perc' => $percentage,
                'vacancy' => max(0, $capacity - $dept->employees_count)
            ];
        })->toArray();
    }

    private function getSparklineData()
    {
        $days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $days->push(now()->subDays($i)->format('Y-m-d'));
        }

        $attendance = Attendance::where('date', '>=', now()->subDays(7))
            ->select('date', DB::raw('count(*) as count'))
            ->groupBy('date')
            ->pluck('count', 'date');

        $leaves = Leave::where('from_date', '>=', now()->subDays(7))
            ->select('from_date', DB::raw('count(*) as count'))
            ->groupBy('from_date')
            ->pluck('count', 'from_date');

        return [
            'attendance' => $days->map(fn($d) => $attendance[$d] ?? 0)->values(),
            'leaves' => $days->map(fn($d) => $leaves[$d] ?? 0)->values(),
        ];
    }

    private function getDateRange($period)
    {
        switch ($period) {
            case 'week':
                return [now()->startOfWeek(), now()->endOfWeek()];
            case 'month':
                return [now()->startOfMonth(), now()->endOfMonth()];
            case 'today':
            default:
                return [now()->startOfDay(), now()->endOfDay()];
        }
    }

    private function getDeptDistribution()
    {
        $distribution = Department::withCount('employees')->get();
        return [
            'names' => $distribution->pluck('name'),
            'counts' => $distribution->pluck('employees_count'),
        ];
    }
}
