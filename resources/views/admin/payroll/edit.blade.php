@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Edit Payroll Details</h5>
            <a href="{{ route('payroll.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            
            <div class="alert alert-info mb-4">
                <strong>Employee:</strong> {{ $payroll->employee->name ?? 'N/A' }} <br>
                <strong>Month:</strong> {{ date('F Y', strtotime($payroll->month)) }}
            </div>

            <form action="{{ route('payroll.update', $payroll->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="basic_salary" class="form-label fw-bold">Basic Salary (Rs.)</label>
                        <input type="number" step="0.01" class="form-control @error('basic_salary') is-invalid @enderror" id="basic_salary" name="basic_salary" value="{{ old('basic_salary', $payroll->basic_salary) }}" required>
                        @error('basic_salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="bonus" class="form-label fw-bold">Bonus (Rs.)</label>
                        <input type="number" step="0.01" class="form-control @error('bonus') is-invalid @enderror" id="bonus" name="bonus" value="{{ old('bonus', $payroll->bonus) }}" required>
                        @error('bonus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="absents" class="form-label fw-bold">Absents (Days)</label>
                        <input type="number" class="form-control @error('absents') is-invalid @enderror" id="absents" name="absents" value="{{ old('absents', $payroll->absents) }}" required>
                        @error('absents')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="leaves" class="form-label fw-bold">Approved Leaves (Days)</label>
                        <input type="number" class="form-control @error('leaves') is-invalid @enderror" id="leaves" name="leaves" value="{{ old('leaves', $payroll->leaves) }}" required>
                        @error('leaves')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="deductions" class="form-label fw-bold">Deductions (Rs.)</label>
                        <input type="number" step="0.01" class="form-control @error('deductions') is-invalid @enderror" id="deductions" name="deductions" value="{{ old('deductions', $payroll->deductions) }}" required>
                        @error('deductions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Manually calculated based on absents or other factors.</small>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('payroll.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Changes & Recalculate Net Salary
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
