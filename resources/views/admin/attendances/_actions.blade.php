<div class="btn-group">
    <a href="{{ route('attendances.show', $id) }}" class="btn btn-sm btn-outline-info">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ route('attendances.edit', $id) }}" class="btn btn-sm btn-outline-warning">
        <i class="bi bi-pencil"></i>
    </a>
    <button data-id="{{ $id }}" class="btn btn-sm btn-outline-danger deleteBtn">
        <i class="bi bi-trash"></i>
    </button>
</div>
