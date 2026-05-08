<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $period = request('period', 'today');
        $sort = request('sort', 'newest');
        $stats = $this->service->getDashboardStats($period, $sort);

        return view('admin.dashboard', [
            'period' => $period,
            'sort' => $sort,
            'user' => Auth::user(),
            'totalEmployees' => $stats['totalEmployees'],
            'totalDepartments' => $stats['totalDepartments'],
            'pendingLeaves' => $stats['pendingLeaves'],
            'totalPayroll' => $stats['totalPayroll'],
            'recentActivity' => $stats['recentActivity'],
            'deptNames' => $stats['deptDistribution']['names'],
            'deptCounts' => $stats['deptDistribution']['counts'],
            'sparklines' => $stats['sparklines'],
            'attendanceTrends' => $stats['attendanceTrends'],
            'payrollTrends' => $stats['payrollTrends'],
            'internalVacancies' => $stats['internalVacancies'],
            'staffingLevels' => $stats['staffingLevels'],
            'featuredDepartments' => $stats['featuredDepartments'],
            'moduleProgress' => $stats['moduleProgress'],
            'totalPayrollExpense' => $stats['totalPayrollExpense'], // Added this
        ]);
    }
}
