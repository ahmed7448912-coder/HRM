@extends('admin.layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ __('Profile') }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Profile') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Update Profile Information -->
            <div class="col-md-6">
                <!--begin::Profile Information-->
                <div class="card card-primary card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">{{ __('Profile Information') }}</div>
                    </div>
                    <!--end::Header-->
                    @include('profile.partials.update-profile-information-form')
                </div>
                <!--end::Profile Information-->
            </div>

            <!-- Update Password -->
            <div class="col-md-6">
                <!--begin::Update Password-->
                <div class="card card-warning card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">{{ __('Update Password') }}</div>
                    </div>
                    <!--end::Header-->
                    @include('profile.partials.update-password-form')
                </div>
                <!--end::Update Password-->
            </div>

            <!-- Delete User -->
            <div class="col-md-12">
                <!--begin::Delete Account-->
                <div class="card card-danger card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title text-danger">{{ __('Delete Account') }}</div>
                    </div>
                    <!--end::Header-->
                    @include('profile.partials.delete-user-form')
                </div>
                <!--end::Delete Account-->
            </div>
        </div>
    </div>
</div>
@endsection