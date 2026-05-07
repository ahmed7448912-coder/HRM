<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employees;

class Payroll extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'month',
        'basic_salary',
        'absents',
        'leaves',
        'deductions',
        'bonus',
        'net_salary',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }
}
