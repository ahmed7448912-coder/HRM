@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Attendance Details</h5>
            <a href="{{ route('attendances.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Employee Name</label>
                    <p class="fs-5 mb-0">{{ $attendance->employee->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Status</label>
                    <div>
                        @if($attendance->status == 'present')
                            <span class="badge bg-success px-3 py-2">Present</span>
                        @else
                            <span class="badge bg-danger px-3 py-2">Absent</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Date</label>
                    <p class="fs-5 mb-0"><i class="bi bi-calendar-event me-1"></i> {{ $attendance->date }}</p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Check In</label>
                    <p class="fs-5 mb-0">
                        <i class="bi bi-clock me-1"></i>
                        @if($attendance->check_in)
                            {{ date('h:i A', strtotime($attendance->check_in)) }}
                            @php
                                try {
                                    $checkInTime = \Carbon\Carbon::parse($attendance->check_in);
                                    $workStartTime = \Carbon\Carbon::parse('09:00:00');
                                    if ($checkInTime->gt($workStartTime)) {
                                        $minutesLate = $checkInTime->diffInMinutes($workStartTime);
                                        echo ' <span class="badge bg-warning text-dark ms-1" style="font-size: 0.75rem;"><i class="bi bi-exclamation-triangle-fill me-1"></i>Late (' . $minutesLate . 'm)</span>';
                                    }
                                } catch (\Exception $e) {}
                            @endphp
                        @else
                            -
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Check Out</label>
                    <p class="fs-5 mb-0">
                        <i class="bi bi-clock-fill me-1"></i>
                        {{ $attendance->check_out ? date('h:i A', strtotime($attendance->check_out)) : '-' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white py-3 border-top-0">
            <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-warning px-4">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection
