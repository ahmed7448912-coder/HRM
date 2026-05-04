@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Leave Details</h5>
            <a href="{{ route('leave.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Employee Name</label>
                    <p class="fs-5 mb-0">{{ $leave->employee->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Status</label>
                    <div>
                        @if($leave->status == 'approved')
                            <span class="badge bg-success px-3 py-2">Approved</span>
                        @elseif($leave->status == 'rejected')
                            <span class="badge bg-danger px-3 py-2">Rejected</span>
                        @else
                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Leave Type</label>
                    <p class="fs-5 mb-0">{{ $leave->type }}</p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Duration</label>
                    <p class="fs-5 mb-0">
                        <i class="bi bi-calendar-event me-1"></i> {{ $leave->from_date }} 
                        <span class="mx-2 text-muted">to</span> 
                        <i class="bi bi-calendar-check me-1"></i> {{ $leave->to_date }}
                    </p>
                </div>
                <div class="col-12">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Reason for Leave</label>
                    <div class="p-3 bg-light rounded">
                        {{ $leave->reason ?: 'No reason provided.' }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white py-3 border-top-0">
            <a href="{{ route('leave.edit', $leave->id) }}" class="btn btn-warning px-4">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection
