<div class="btn-group">
    <a href="{{ route('departments.edit', $id) }}" class="btn btn-sm btn-outline-warning">
        <i class="bi bi-pencil"></i>
    </a>
    <form action="{{ route('departments.destroy', $id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('Are you sure you want to delete this department?') }}')">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>
