@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Departments') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Departments') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        @if(session('success'))
            <script>
                window.onload = function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'success',
                        title: "{{ session('success') }}"
                    });
                };
            </script>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-0">{{ __('Department List') }}</h5>
                    <p class="text-muted small mb-0">Manage company departments and their structures.</p>
                </div>
                <div class="card-tools">
                    <a href="{{ route('departments.create') }}" class="btn btn-primary rounded-3 shadow-sm px-3">
                        <i class="bi bi-plus-lg me-1"></i> {{ __('Add Department') }}
                    </a>
                </div>
            </div>
            <div class="card-body px-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 w-100" id="departments-table">
                        <thead class="small text-uppercase">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th style="width: 150px" class="text-end">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/admin/departments.js') }}"></script>
@endpush