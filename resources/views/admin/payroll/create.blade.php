@extends('admin.layouts.app')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush
<div class="container-fluid p-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0 fw-bold">Generate Payroll</h2>
            <small class="text-muted">Select a month and generate payroll for all employees</small>
        </div>
        <a href="{{ route('payroll.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Payroll
        </a>
    </div>

    {{-- Flash Message --}}
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

    {{-- Generate Card --}}
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card card-primary card-outline shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-lightning-charge-fill text-primary me-2"></i>
                        Payroll Generation
                    </h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('payroll.store') }}" method="POST" id="generatePayrollForm">
                        @csrf

                        <div class="mb-4">
                            <label for="month" class="form-label fw-semibold">Select Month</label>
                            <input
                                type="month"
                                id="month"
                                name="month"
                                class="form-control form-control-lg @error('month') is-invalid @enderror"
                                value="{{ old('month', now()->format('Y-m')) }}"
                                required
                            >
                            @error('month')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted mt-1 d-block">
                                Payroll will be calculated based on attendance and leaves for the selected month.
                            </small>
                        </div>

                        {{-- Summary Info Box --}}
                        <div class="alert alert-info d-flex align-items-start gap-2 mb-4">
                            <i class="bi bi-info-circle-fill mt-1"></i>
                            <div>
                                <strong>What happens when you generate?</strong>
                                <ul class="mb-0 mt-1 ps-3">
                                    <li>Payroll is calculated for <strong>all active employees</strong>.</li>
                                    <li>Absences are deducted at <strong>Rs. 500/day</strong>.</li>
                                    <li>If payroll for the month already exists, it is <strong>updated</strong>.</li>
                                    <li>A payslip email is dispatched to each employee.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="bi bi-lightning-charge-fill me-1"></i> Generate Payroll
                            </button>
                            <a href="{{ route('payroll.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('generatePayrollForm').addEventListener('submit', function () {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Generating...';
    });
</script>
@endpush
