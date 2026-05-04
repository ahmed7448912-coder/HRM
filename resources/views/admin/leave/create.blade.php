@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Apply for Leave</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('leave.store') }}" method="POST">
                @csrf
                @include('admin.leave._form')

                <div class="mt-4">
                    <button class="btn btn-success">Save Leave Request</button>
                    <a href="{{ route('leave.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection