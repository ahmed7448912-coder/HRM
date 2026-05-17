@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Salary Management</h3>
        <a href="{{ route('salary.transactions') }}" class="btn btn-outline-secondary btn-sm">
            View Transaction Log
        </a>
    </div>

    @foreach(['success','error','info'] as $msg)
    @if(session($msg))
    <div class="alert alert-{{ $msg === 'error' ? 'danger' : ($msg === 'info' ? 'info' : 'success') }}">
        {{ session($msg) }}
    </div>
    @endif
    @endforeach

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Employee</th>
                <th>Month</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Paid At</th>
                <th>Email Sent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaries as $salary)
            <tr>
                <td>{{ $salary->employee->name }}</td>
                <td>{{ $salary->month }}</td>
                <td>${{ number_format($salary->amount, 2) }}</td>
                <td>
                    @if($salary->status === 'paid')
                    <span class="badge bg-success">Paid</span>
                    @else
                    <span class="badge bg-danger">Unpaid</span>
                    @endif
                </td>
                <td>{{ $salary->paid_at ? $salary->paid_at->format('d M Y') : '—' }}</td>
                <td>
                    @php $tx = $salary->transactions->last(); @endphp
                    @if($tx && $tx->email_sent_at)
                    <small class="text-success">{{ $tx->email_sent_at->format('d M, h:i A') }}</small>
                    @else
                    <small class="text-muted">Not sent</small>
                    @endif
                </td>
                <td>
                    @if($salary->status === 'unpaid')
                    <a href="{{ route('salary.pay', $salary->id) }}"
                        class="btn btn-sm btn-primary">Pay</a>
                    @else
                    <form action="{{ route('salary.resend-email', $salary->id) }}"
                        method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-outline-secondary">
                            Resend Email
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $salaries->links() }}
</div>
@endsection