<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveRequest;
use App\Models\Employees;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Services\LeaveService;
use Yajra\DataTables\Facades\DataTables;

class LeaveController extends Controller
{
    public function __construct(private LeaveService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $leaves = $this->service->all();

            return DataTables::of($leaves)
                ->addIndexColumn()
                ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
                ->addColumn('status', function ($row) {
                    return "<span class='badge bg-primary'>{$row->status}</span>";
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('leave.show', $row->id) . '" class="btn btn-sm btn-info text-white">Show</a>
                        <a href="' . route('leave.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button data-id="' . $row->id . '" class="btn btn-sm btn-danger deleteBtn">Delete</button>
                    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('admin.leave.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employees::pluck('name', 'id');
        return view('admin.leave.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveRequest $request)
    {
        $this->service->apply($request->validated());
        return redirect()->route('leave.index')->with('success', 'Leave created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        return view('admin.leave.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        $employees = Employees::pluck('name', 'id');
        return view('admin.leave.edit', compact('leave', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveRequest $request, Leave $leave)
    {
        $this->service->update($leave, $request->validated());
        return redirect()->route('leave.index')->with('success', 'Leave updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        $this->service->delete($leave);
        return response()->json(['success' => true]);
    }

    /**
     * Update leave status.
     */
    public function updateStatus(Leave $leave, Request $request)
    {
        $this->service->updateStatus($leave, $request->status);
        return back()->with('success', 'Status Updated');
    }
}
