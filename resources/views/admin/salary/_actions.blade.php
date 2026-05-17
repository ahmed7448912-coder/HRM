@if($status === 'unpaid')
    <a href="{{ route('salary.pay', $id) }}" class="btn btn-sm btn-primary rounded-3 px-3 shadow-sm">
        <i class="bi bi-credit-card me-1"></i> Pay Now
    </a>
@else
    <form action="{{ route('salary.resend-email', $id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-secondary rounded-3 px-2 shadow-sm" title="Resend Receipt">
            <i class="bi bi-envelope-at"></i>
        </button>
    </form>
@endif
