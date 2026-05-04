@extends('layouts.admin')

@section('content')
<form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
    @csrf
    @method('PUT')

    @include('admin.attendance._form')

    <button class="btn btn-primary">Update</button>
</form>
@endsection