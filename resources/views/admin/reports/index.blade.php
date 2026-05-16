@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Attendance Reports') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Reports') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0"><i class="bi bi-filter me-2 text-primary"></i> {{ __('Filter Options') }}</h5>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small text-muted text-uppercase">{{ __('From Date') }}</label>
                        <input type="date" id="from_date" class="form-control rounded-3 shadow-sm">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small text-muted text-uppercase">{{ __('To Date') }}</label>
                        <input type="date" id="to_date" class="form-control rounded-3 shadow-sm">
                    </div>
                    <div class="col-md-4">
                        <button id="filterAttendance" class="btn btn-primary w-100 rounded-3 shadow-sm py-2">
                            <i class="bi bi-file-earmark-bar-graph-fill me-2"></i> {{ __('Generate Report') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">{{ __('Attendance Data') }}</h5>
                <div class="card-tools">
                    <!-- DataTables Export buttons will be moved here -->
                </div>
            </div>
            <div class="card-body px-4 py-4">
                <div class="table-responsive">
                    <table id="attendanceTable" class="table align-middle mb-0 w-100">
                        <thead class="small text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Employee') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/admin/report.js') }}"></script>
@endpush