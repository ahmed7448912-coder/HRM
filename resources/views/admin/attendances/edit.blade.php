@extends('admin.layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Edit Attendance') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('attendances.index') }}">{{ __('Attendance') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Edit') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Edit Record') }}</h3>
                    </div>
                    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @include('admin.attendances._form')
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('attendances.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                            <button type="submit" class="btn btn-warning">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
