@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
            margin-right: 5px;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffc107;
        }
        .star-rating label .bi-star-fill {
            display: none;
        }
        .star-rating input:checked ~ label .bi-star-fill,
        .star-rating label:hover .bi-star-fill,
        .star-rating label:hover ~ label .bi-star-fill {
            display: inline-block;
        }
        .star-rating input:checked ~ label .bi-star,
        .star-rating label:hover .bi-star,
        .star-rating label:hover ~ label .bi-star {
            display: none;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Performance Reviews</h2>
        <button id="addPerformance" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg"></i> Add Review
        </button>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table id="performanceTable" class="table table-hover w-100">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Performance Modal -->
<div class="modal fade" id="performanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modalTitle">Add Performance Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="performanceForm">
                @csrf
                <input type="hidden" id="performanceId" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-select shadow-sm" required>
                            <option value="">Select Employee</option>
                            @foreach($employees as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Rating</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars"><i class="bi bi-star"></i><i class="bi bi-star-fill"></i></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars"><i class="bi bi-star"></i><i class="bi bi-star-fill"></i></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"><i class="bi bi-star"></i><i class="bi bi-star-fill"></i></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars"><i class="bi bi-star"></i><i class="bi bi-star-fill"></i></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"><i class="bi bi-star"></i><i class="bi bi-star-fill"></i></label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Review</label>
                        <textarea name="review" id="review" class="form-control shadow-sm" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Review Date</label>
                        <input type="date" name="review_date" id="review_date" class="form-control shadow-sm" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/admin/performance.js') }}"></script>
@endpush