@if($status === 'unpaid')
    <a href="{{ route('salary.pay', $id) }}" class="btn btn-sm btn-primary rounded-3 px-3 shadow-sm">
        <i class="bi bi-credit-card me-1"></i> Pay Now
    </a>
@else
    <div class="d-flex align-items-center gap-1">
        <form action="{{ route('salary.resend-email', $id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary rounded-3 px-2 shadow-sm" title="Resend Receipt">
                <i class="bi bi-envelope-at"></i>
            </button>
        </form>
        <form action="{{ route('salary.cancel', $id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this payment and reset status to unpaid?');">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 px-2 shadow-sm" title="Cancel & Reset Payment">
                <i class="bi bi-x-circle"></i> Reset
            </button>
        </form>
    </div>
@endif
