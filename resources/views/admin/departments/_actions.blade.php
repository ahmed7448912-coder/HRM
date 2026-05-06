<div class="btn-group">
    <a href="{{ route('departments.show', $id) }}" class="btn btn-sm btn-outline-info" title="View Details">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ route('departments.edit', $id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    <button data-id="{{ $id }}" class="btn btn-sm btn-outline-danger deleteBtn" title="Delete">
        <i class="bi bi-trash"></i>
    </button>
</div>
