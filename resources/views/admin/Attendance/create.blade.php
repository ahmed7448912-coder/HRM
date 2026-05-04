@extends('layouts.admin')

@section('content')
<form action="{{ route('attendance.store') }}" method="POST">
    @csrf

    @include('admin.attendance._form')

    <button class="btn btn-success">Save</button>
</form>
@endsection