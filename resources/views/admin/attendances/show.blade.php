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
