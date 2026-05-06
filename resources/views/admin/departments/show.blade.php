@extends('admin.layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Department Details') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">{{ __('Departments') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Details') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <!-- Department Info -->
            <div class="col-md-4">
                <div class="card card-primary card-outline shadow-sm border-0">
                    <div class="card-header border-0">
                        <h3 class="card-title">{{ __('Info') }}</h3>
                    </div>
                    <div class="card-body box-profile">
                        <h3 class="profile-username text-center text-primary fw-bold">{{ $department->name }}</h3>
                        <p class="text-muted text-center">{{ $department->code }}</p>

                        <ul class="list-group list-group-unbordered mb-3 mt-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>{{ __('Total Employees') }}</b> 
                                <span class="badge bg-primary rounded-pill">{{ $department->employees->count() }}</span>
                            </li>
                            <li class="list-group-item d-flex flex-column border-bottom-0">
                                <b class="mb-2">{{ __('Description') }}</b> 
                                <span class="text-muted">{{ $department->description ?: 'No description provided.' }}</span>
                            </li>
                        </ul>

                        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning w-100">
                            <b><i class="bi bi-pencil me-1"></i> Edit Department</b>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Employees List -->
            <div class="col-md-8">
                <div class="card card-primary card-outline shadow-sm border-0">
                    <div class="card-header border-0">
                        <h3 class="card-title">{{ __('Employees in this Department') }}</h3>
                    </div>
                    <div class="card-body p-0">
                        @if($department->employees->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped align-middle mb-0">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="ps-3">{{ __('Employee') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Joining Date') }}</th>
                                            <th class="text-center">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($department->employees as $emp)
                                            <tr>
                                                <td class="ps-3">
                                                    <div class="d-flex align-items-center">
                                                        @if($emp->image)
                                                            <img src="{{ asset('storage/' . $emp->image) }}" class="img-circle me-2" width="40" height="40" style="object-fit: cover;">
                                                        @else
                                                            <img src="{{ asset('assets/img/avatar5.png') }}" class="img-circle me-2" width="40" height="40" style="object-fit: cover;">
                                                        @endif
                                                        <span class="fw-bold">{{ $emp->name }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $emp->email }}</td>
                                                <td>{{ \Carbon\Carbon::parse($emp->joining_date)->format('M d, Y') }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('employees.show', $emp->id) }}" class="btn btn-sm btn-outline-info">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center p-5 text-muted">
                                <i class="bi bi-people display-4 d-block mb-3"></i>
                                <h5>No employees found in this department.</h5>
                                <p>You can add new employees and assign them to this department.</p>
                                <a href="{{ route('employees.create') }}" class="btn btn-primary mt-2">Add Employee</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
