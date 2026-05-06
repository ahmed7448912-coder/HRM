<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Employees;
use App\Services\AttendanceService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    protected $service;

    public function __construct(AttendanceService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $attendance = Attendance::with('employee')->select('attendances.*');

            return DataTables::of($attendance)
                ->addIndexColumn()
                ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
                ->addColumn('status', function($row) {
                    $badgeClass = $row->status == 'present' ? 'bg-success' : 'bg-danger';
                    return '<span class="badge ' . $badgeClass . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('actions', 'admin.attendances._actions')
                ->rawColumns(['status', 'actions'])
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
        $this->service->mark($request->validated());

        return redirect()->back()->with('success', 'Attendance saved');
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
