<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employees;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{


    protected $service;

    public function __construct(EmployeeService $service)
    {
        $this->service = $service;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getDatatable();
        }

        return view('admin.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::pluck('name', 'id');

        return view('admin.employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('employees.index')
            ->with('success', 'Employee created and welcome email sent!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employees $employee)
    {
        $employee->load('department');
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employees $employee)
    {
        $departments = Department::pluck('name', 'id');

        return view('admin.employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employees $employee)
    {
        $this->service->update($employee, $request->validated());

        return redirect()->route('employees.index')
            ->with('success', 'Updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employees $employee)
    {
        $this->service->delete($employee);

        return response()->json(['success' => true]);
    }
}
