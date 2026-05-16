@extends('admin.layouts.app')

@push('styles')
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
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Performance Reviews') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Performance') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-0">{{ __('Performance Reviews') }}</h5>
                    <p class="text-muted small mb-0">Evaluate employee performance and provide feedback.</p>
                </div>
                <div class="card-tools">
                    <button id="addPerformance" class="btn btn-primary rounded-3 shadow-sm px-3">
                        <i class="bi bi-plus-lg me-2"></i> {{ __('Add Review') }}
                    </button>
                </div>
            </div>
            <div class="card-body px-4">
                <div class="table-responsive">
                    <table id="performanceTable" class="table align-middle mb-0 w-100">
                        <thead class="small text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Employee') }}</th>
                                <th>{{ __('Rating') }}</th>
                                <th>{{ __('Review') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Performance Modal -->
<div class="modal fade" id="performanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modalTitle">Add Performance Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="performanceForm">
                @csrf
                <input type="hidden" id="performanceId" name="id">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-select rounded-3 shadow-sm" required>
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
                        <textarea name="review" id="review" class="form-control rounded-3 shadow-sm" rows="3" placeholder="Enter feedback..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Review Date</label>
                        <input type="date" name="review_date" id="review_date" class="form-control rounded-3 shadow-sm" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm">Save Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/admin/performance.js') }}"></script>
@endpush