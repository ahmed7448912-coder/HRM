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
                ->editColumn('check_in', function($row) {
                    if (!$row->check_in) {
                        return '-';
                    }

                    $formattedTime = date('h:i A', strtotime($row->check_in));

                    try {
                        $checkInTime = \Carbon\Carbon::parse($row->check_in);
                        $workStartTime = \Carbon\Carbon::parse('09:00:00');

                        if ($checkInTime->gt($workStartTime)) {
                            $minutesLate = $checkInTime->diffInMinutes($workStartTime);
                            return e($formattedTime) . ' <span class="badge bg-warning text-dark ms-1" style="font-size: 0.75rem;"><i class="bi bi-exclamation-triangle-fill me-1"></i>Late (' . $minutesLate . 'm)</span>';
                        }
                    } catch (\Exception $e) {
                        // fallback
                    }

                    return e($formattedTime);
                })
                ->editColumn('check_out', function($row) {
                    return $row->check_out ? e(date('h:i A', strtotime($row->check_out))) : '-';
                })
                ->addColumn('status', function($row) {
                    $badgeClass = $row->status == 'present' ? 'bg-success' : 'bg-danger';
                    return '<span class="badge ' . $badgeClass . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('actions', 'admin.attendances._actions')
                ->rawColumns(['status', 'check_in', 'actions'])
                ->make(true);
        }

        return view('admin.attendances.index');
    }

    public function create()
    {
        $employees = Employees::pluck('name', 'id');
        return view('admin.attendances.create', compact('employees'));
    }

    public function store(AttendanceRequest $request)
    {
        $this->service->mark($request->validated());

        return redirect()->route('attendances.index')->with('success', 'Attendance saved successfully!');
    }

    public function show(Attendance $attendance)
    {
        $attendance->load('employee');
        return view('admin.attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employees::pluck('name', 'id');
        return view('admin.attendances.edit', compact('attendance', 'employees'));
    }

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
