<?php

namespace App\Repositories;

use App\Models\Leave;

class LeaveRepository
{
    public function all()
    {
        return Leave::with('employee')->latest();
    }

    public function create(array $data)
    {
        return Leave::create($data);
    }

    public function update(Leave $leave, array $data)
    {
        return $leave->update($data);
    }

    public function delete(Leave $leave)
    {
        return $leave->delete();
    }
}
