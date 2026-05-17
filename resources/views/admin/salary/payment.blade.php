@extends('admin.layouts.app')

@section('content')
<div class="container" style="max-width:520px">
    <h3 class="mb-4">Pay Salary</h3>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card p-4">
        <div class="mb-3">
            <strong>Employee:</strong> {{ $salary->employee->name }}<br>
            <strong>Month:</strong> {{ $salary->month }}<br>
            <strong>Amount:</strong> ${{ number_format($salary->amount, 2) }}
        </div>

        <form id="payment-form" 
              action="{{ route('salary.process', $salary->id) }}" 
              method="POST"
              data-stripe-key="{{ config('services.stripe.key') }}"
              data-employee-name="{{ $salary->employee->name }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Card Details</label>
                <div id="card-element" class="form-control" style="padding-top:10px;min-height:42px;"></div>
                <div id="card-errors" class="text-danger mt-1" role="alert"></div>
            </div>

            <input type="hidden" id="payment_method_id" name="payment_method_id">

            <button id="submit-btn" type="submit" class="btn btn-success w-100">
                <span id="btn-text">Pay ${{ number_format($salary->amount, 2) }}</span>
                <span id="btn-loading" style="display:none;">Processing...</span>
            </button>
        </form>
    </div>
</div>

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/salary/stripe-payment.js') }}"></script>
@endpush
@endsection