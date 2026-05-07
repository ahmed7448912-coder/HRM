<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\Payroll;
use App\Services\PayrollService;
use Yajra\DataTables\Facades\DataTables;

class PayrollController extends Controller
{
    /**
     * Display the payroll listing.
     * Returns DataTable JSON when called via AJAX.
     */
    public function index()
    {
        if (request()->ajax()) {
            $payrolls = Payroll::with('employee')->select('payrolls.*');

            return DataTables::of($payrolls)
                ->addIndexColumn()
                ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
                ->addColumn('month', fn($row) => date('F Y', strtotime($row->month)))
                ->make(true);
        }

        return view('admin.payroll.index');
    }

    /**
     * Show the Generate Payroll form.
     */
    public function create()
    {
        return view('admin.payroll.create');
    }

    /**
     * Process and generate payroll for all employees.
     */
    public function store(PayrollService $service)
    {
        $month = request('month', now()->format('Y-m'));

        $employees = Employees::all();

        foreach ($employees as $emp) {
            $service->processPayroll($emp->id, $month);
        }

        return redirect()->route('payroll.index')
            ->with('success', 'Payroll generated successfully for ' . date('F Y', strtotime($month . '-01')) . '!');
    }
}

