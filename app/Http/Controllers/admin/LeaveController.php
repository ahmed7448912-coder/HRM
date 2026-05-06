<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveRequest;
use App\Models\Employees;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Services\LeaveService;

class LeaveController extends Controller
{
    public function __construct(private LeaveService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getDataTable();
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
        
        return $request->ajax() 
            ? response()->json(['success' => true, 'message' => 'Updated Successfully']) 
            : redirect()->route('leave.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        $this->service->delete($leave);
        return response()->json(['success' => true]);
    }
}
