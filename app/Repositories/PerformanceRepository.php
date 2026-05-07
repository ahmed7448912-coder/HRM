<?php

namespace App\Repositories;

use App\Models\Performance;

class PerformanceRepository
{
    public function create(array $data)
    {
        return Performance::create($data);
    }

    public function update(Performance $performance, array $data)
    {
        return $performance->update($data);
    }

    public function delete(Performance $performance)
    {
        return $performance->delete();
    }

    public function all()
    {
        return Performance::with('employee')->latest();
    }
}
