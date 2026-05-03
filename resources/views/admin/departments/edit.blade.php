@extends('admin.layouts.app')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Edit Department') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">{{ __('Departments') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--end::App Content Header-->

<!--begin::App Content-->
<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-12">
                <div class="card card-warning card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title">{{ __('Edit Department') }}: {{ $department->name }}</div>
                    </div>
                    <form action="{{ route('departments.update', $department->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.departments._form', ['department' => $department])

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">{{ __('Update Department') }}</button>
                            <a href="{{ route('departments.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::App Content-->
@endsection