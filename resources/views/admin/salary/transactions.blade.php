@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Transaction Log') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('salary.index') }}">Salary Payments</a></li>
                    <li class="breadcrumb-item active">{{ __('Transactions') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-0">{{ __('Salary Transactions') }}</h5>
                    <p class="text-muted small mb-0">View all completed and failed salary transactions via Stripe.</p>
                </div>
                <div class="card-tools">
                    <a href="{{ route('salary.index') }}" class="btn btn-outline-secondary rounded-3 shadow-sm px-3">
                        <i class="bi bi-arrow-left me-2"></i> {{ __('Back to Salaries') }}
                    </a>
                </div>
            </div>
            <div class="card-body px-4">
                <div class="table-responsive">
                    <table id="transactionsTable" class="table align-middle mb-0 w-100">
                        <thead class="small text-uppercase text-muted">
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Month</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Actions</th>
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
<script src="{{ asset('assets/js/admin/salary-transactions.js') }}"></script>
@endpush
