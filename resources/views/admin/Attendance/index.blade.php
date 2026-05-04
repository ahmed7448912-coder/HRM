@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Attendance</h2>

    <a href="{{ route('attendance.create') }}" class="btn btn-primary mb-3">
        Mark Attendance
    </a>

    <table id="attendanceTable" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/attendance.js') }}"></script>
@endpush