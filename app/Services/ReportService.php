<?php

namespace App\Services;

use App\Repositories\ReportRepository;
use Yajra\DataTables\Facades\DataTables;

class ReportService
{
    protected $repo;

    public function __construct(ReportRepository $repo)
    {
        $this->repo = $repo;
    }

    public function attendance($filters)
    {
        return $this->repo->attendanceReport($filters);
    }

    public function payroll($filters)
    {
        return $this->repo->payrollReport($filters);
    }

    public function leave($filters)
    {
        return $this->repo->leaveReport($filters);
    }

    public function getDatatable($type, $filters)
    {
        switch ($type) {
            case 'attendance':
                return DataTables::of($this->attendance($filters))
                    ->addIndexColumn()
                    ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
                    ->editColumn('date', fn($row) => date('M d, Y', strtotime($row->date)))
                    ->editColumn('status', function($row) {
                        $class = strtolower($row->status) == 'present' ? 'success' : 'danger';
                        return '<span class="badge bg-' . $class . '">' . ucfirst($row->status) . '</span>';
                    })
                    ->rawColumns(['status'])
                    ->make(true);

            case 'leave':
                return DataTables::of($this->leave($filters))
                    ->addIndexColumn()
                    ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
                    ->make(true);

            case 'payroll':
                return DataTables::of($this->payroll($filters))
                    ->addIndexColumn()
                    ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
                    ->make(true);

            default:
                throw new \Exception('Invalid report type');
        }
    }
}
