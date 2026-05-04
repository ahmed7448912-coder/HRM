<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Employees;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $attendance = Attendance::with('employee')->select('attendances.*');

            return DataTables::of($attendance)
                ->addIndexColumn()
                ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
                ->addColumn('actions', 'admin.attendances._actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.attendances.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employees::pluck('name', 'id');
        return view('admin.attendances.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {
        Attendance::updateOrCreate(
            [
                'employee_id' => $request->employee_id,
                'date' => $request->date,
            ],
            [
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
            ]
        );

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        $employees = Employees::pluck('name', 'id');
        return view('admin.attendances.edit', compact('attendance', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->validated());

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance updated successfully');
    }


    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return response()->json(['success' => true]);
    }
}
