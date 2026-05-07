@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Payroll Details</h5>
            <a href="{{ route('payroll.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Employee Name</label>
                    <p class="fs-5 mb-0">{{ $payroll->employee->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Payroll Month</label>
                    <p class="fs-5 mb-0">{{ date('F Y', strtotime($payroll->month)) }}</p>
                </div>
                
                <hr class="my-4">

                <div class="col-md-4">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Basic Salary</label>
                    <p class="fs-5 mb-0 text-primary">Rs. {{ number_format($payroll->basic_salary, 2) }}</p>
                </div>
                <div class="col-md-4">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Bonus</label>
                    <p class="fs-5 mb-0 text-success">Rs. {{ number_format($payroll->bonus, 2) }}</p>
                </div>
                <div class="col-md-4">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Deductions</label>
                    <p class="fs-5 mb-0 text-danger">Rs. {{ number_format($payroll->deductions, 2) }}</p>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Absents</label>
                    <p class="fs-5 mb-0">{{ $payroll->absents }} Days</p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Approved Leaves</label>
                    <p class="fs-5 mb-0">{{ $payroll->leaves }} Days</p>
                </div>

                <hr class="my-4">

                <div class="col-12 text-end bg-light p-4 rounded">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Total Net Salary</label>
                    <h2 class="mb-0 fw-bold text-dark">Rs. {{ number_format($payroll->net_salary, 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white py-3 border-top-0 text-end">
            <a href="{{ route('payroll.edit', $payroll->id) }}" class="btn btn-warning px-4">
                <i class="bi bi-pencil-square"></i> Edit Payroll
            </a>
        </div>
    </div>
</div>
@endsection
