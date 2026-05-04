@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Leave Request</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('leave.update', $leave->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.leave._form')

                <div class="mt-4">
                    <button class="btn btn-primary">Update Leave Request</button>
                    <a href="{{ route('leave.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection