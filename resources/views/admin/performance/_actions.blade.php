<div class="btn-group">
    <button class="btn btn-sm btn-outline-warning editBtn" 
        data-id="{{ $id }}" 
        data-employee_id="{{ $employee_id }}"
        data-rating="{{ $rating }}"
        data-review="{{ $review }}"
        data-review_date="{{ $review_date }}">
        <i class="bi bi-pencil"></i>
    </button>
    <button class="btn btn-sm btn-outline-danger deleteBtn" data-id="{{ $id }}">
        <i class="bi bi-trash"></i>
    </button>
</div>
