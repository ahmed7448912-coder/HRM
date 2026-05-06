<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Employees;

class EmployeeRepository
{
    public function all()
    {
        return Employees::with('department')->latest();
    }

    public function create(array $data)
    {
        return Employees::create($data);
    }

    public function update(Employees $employee, array $data)
    {
        return $employee->update($data);
    }

    public function delete(Employees $employee)
    {
        return $employee->delete();
    }
}
