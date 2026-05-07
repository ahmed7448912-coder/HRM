@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="container-fluid p-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0 fw-bold">Payroll Management</h2>
            <small class="text-muted">Manage and generate monthly payroll for all employees</small>
        </div>
        <a href="{{ route('payroll.create') }}" class="btn btn-primary">
            <i class="bi bi-lightning-charge-fill me-1"></i> Generate Payroll
        </a>
    </div>

    {{--flash message--}}
    @if(session('success'))
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
                icon: 'success',
                title: "{{ session('success') }}"
            });
        };
    </script>
    @endif

    {{-- Table Card --}}
    <div class="card card-primary card-outline shadow-sm border-0">
        <div class="card-body">
            <table id="payrollTable" class="table table-striped w-100">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Month</th>
                        <th>Basic Salary</th>
                        <th>Absents</th>
                        <th>Deductions</th>
                        <th>Net Salary</th>
                        <th class="text-center">Actions</th>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/admin/payroll.js') }}"></script>
@endpush