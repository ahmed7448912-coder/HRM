@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Salary Management') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Salary') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        
        @if(session('success') || session('error') || session('info'))
        <script>
            window.onload = function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                Toast.fire({
                    icon: '{{ session("error") ? "error" : (session("info") ? "info" : "success") }}',
                    title: "{{ session('success') ?? session('error') ?? session('info') }}"
                });
            };
        </script>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-0">{{ __('Salary Payments') }}</h5>
                    <p class="text-muted small mb-0">Manage employee salaries and process payments.</p>
                </div>
                <div class="card-tools">
                    <a href="{{ route('salary.transactions') }}" class="btn btn-outline-primary rounded-3 shadow-sm px-3">
                        <i class="bi bi-clock-history me-2"></i> {{ __('Transaction Log') }}
                    </a>
                </div>
            </div>
            <div class="card-body px-4">
                <div class="table-responsive">
                    <table id="salaryTable" class="table align-middle mb-0 w-100">
                        <thead class="small text-uppercase text-muted">
                            <tr>
                                <th>{{ __('Employee') }}</th>
                                <th>{{ __('Month') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Paid At') }}</th>
                                <th>{{ __('Email Status') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
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
<script src="{{ asset('assets/js/admin/salary.js') }}"></script>
@endpush