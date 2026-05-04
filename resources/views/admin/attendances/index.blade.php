@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Attendance') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Attendance') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header border-0">
                <h3 class="card-title">{{ __('Attendance Records') }}</h3>
                <div class="card-tools">
                    <a href="{{ route('attendances.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg me-1"></i> {{ __('Mark Attendance') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped align-middle mb-0" id="attendanceTable" data-url="{{ route('attendances.index') }}">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Employee') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Check In') }}</th>
                                <th>{{ __('Check Out') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets/js/admin/attendance.js') }}"></script>
@endpush
