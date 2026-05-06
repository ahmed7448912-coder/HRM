@extends('admin.layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Employee Profile') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">{{ __('Employees') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Profile') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="card card-primary card-outline shadow-sm border-0 mb-4">
                    <div class="card-body box-profile text-center">
                        <div class="mb-4">
                            @if($employee->image)
                                <img class="profile-user-img img-fluid rounded-circle shadow-sm"
                                     src="{{ asset('storage/' . $employee->image) }}"
                                     alt="User profile picture" style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #dee2e6;">
                            @else
                                <img class="profile-user-img img-fluid rounded-circle shadow-sm"
                                     src="{{ asset('assets/img/avatar5.png') }}"
                                     alt="User profile picture" style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #dee2e6;">
                            @endif
                        </div>
                        <h3 class="profile-username mb-1 fw-bold">{{ $employee->name }}</h3>
                        <p class="text-muted">{{ $employee->department->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary card-outline shadow-sm border-0">
                    <div class="card-header border-0">
                        <h3 class="card-title fw-semibold">{{ __('Detailed Information') }}</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0 w-100">
                            <tbody>
                                <tr>
                                    <th style="width: 30%" class="ps-4 py-3">{{ __('Full Name') }}</th>
                                    <td class="py-3">{{ $employee->name }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-4 py-3">{{ __('Email Address') }}</th>
                                    <td class="py-3"><a href="mailto:{{ $employee->email }}" class="text-decoration-none">{{ $employee->email }}</a></td>
                                </tr>
                                <tr>
                                    <th class="ps-4 py-3">{{ __('Department') }}</th>
                                    <td class="py-3">
                                        @if($employee->department)
                                            <span class="badge bg-info text-dark px-2 py-1">{{ $employee->department->name }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="ps-4 py-3">{{ __('Salary') }}</th>
                                    <td class="py-3 text-success fw-bold">${{ number_format($employee->salary, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-4 py-3">{{ __('Joining Date') }}</th>
                                    <td class="py-3">{{ \Carbon\Carbon::parse($employee->joining_date)->format('F d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-0 bg-light text-end py-3">
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary me-2"><i class="bi bi-arrow-left me-1"></i> {{ __('Back to List') }}</a>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i> {{ __('Edit Profile') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
