@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/approval-status.css') }}">
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">User Approvals</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">User Approvals</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-0">Pending Requests</h5>
                    <p class="text-muted small mb-0">Manage new account registrations that require authorization.</p>
                </div>
                <div class="card-tools">
                    <!-- DataTables Export buttons will be moved here -->
                </div>
            </div>
            <div class="card-body px-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 w-100" id="approvalsTable">
                        <thead class="small text-uppercase">
                            <tr>
                                <th>User Details</th>
                                <th>Email</th>
                                <th>Registered At</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- DataTables will populate this --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#approvalsTable').DataTable({
        ajax: "{{ route('admin.approvals.index') }}",
        columns: [
            { data: 'user_details', name: 'name', orderable: true },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-end' }
        ],
        order: [[2, 'desc']]
    });
});
</script>
@endpush
