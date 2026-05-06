<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{

    protected $service;

    public function __construct(DepartmentService $service)
    {
        $this->service = $service;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Department::latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', 'admin.departments._actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.departments.index');
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(DepartmentRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->back()->with('success', 'Department created');
    }

    public function show(Department $department)
    {
        // Load the employees relationship if needed for the view
        $department->load('employees');
        return view('admin.departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $this->service->update($department, $request->validated());

        return redirect()->back()->with('success', 'Updated');
    }

    public function destroy(Department $department)
    {
        $this->service->delete($department);

        return response()->json(['success' => true]);
    }
}
