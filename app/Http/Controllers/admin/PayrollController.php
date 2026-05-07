<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayrollRequest;
use App\Models\Payroll;
use App\Services\PayrollService;

class PayrollController extends Controller
{
    protected $service;

    public function __construct(PayrollService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->service->getDatatable();
        }

        return view('admin.payroll.index');
    }

    public function create()
    {
        return view('admin.payroll.create');
    }

    public function store()
    {
        $month = request('month', now()->format('Y-m'));
        $this->service->generateAll($month);

        return redirect()->route('payroll.index')
            ->with('success', 'Payroll generated successfully for ' . date('F Y', strtotime($month . '-01')) . '!');
    }

    public function show(Payroll $payroll)
    {
        $payroll->load('employee');
        return view('admin.payroll.show', compact('payroll'));
    }

    public function edit(Payroll $payroll)
    {
        $payroll->load('employee');
        return view('admin.payroll.edit', compact('payroll'));
    }

    public function update(PayrollRequest $request, Payroll $payroll)
    {
        $this->service->update($payroll, $request->validated());

        return redirect()->route('payroll.index')->with('success', 'Payroll record updated successfully!');
    }
}

