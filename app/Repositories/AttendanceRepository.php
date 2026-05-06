<?php

namespace App\Repositories;

use App\Models\Attendance;

class AttendanceRepository
{
    public function create(array $data)
    {
        return Attendance::create($data);
    }

    public function updateOrCreate(array $condition, array $data)
    {
        return Attendance::updateOrCreate($condition, $data);
    }

    public function getByDate($date)
    {
        return Attendance::where('date', $date)->pluck('employee_id')->toArray();
    }
}
