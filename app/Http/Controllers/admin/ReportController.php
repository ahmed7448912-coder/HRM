<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;

class ReportController extends Controller
{
    protected $service;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->service->getDatatable(
                request('type', 'attendance'),
                request()->only(['from_date', 'to_date', 'employee_id'])
            );
        }

        return view('admin.reports.index');
    }
}
