<?php

namespace App\Repositories;

use App\Models\Payroll;

class PayrollRepository
{
    public function create(array $data)
    {
        return Payroll::create($data);
    }

    public function all()
    {
        return Payroll::with('employee')->latest();
    }
}
