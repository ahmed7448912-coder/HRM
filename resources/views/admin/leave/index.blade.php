@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Leave Management</h2>
        <a href="{{ route('leave.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Apply Leave
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="leaveTable" class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets/js/admin/leave.js') }}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush