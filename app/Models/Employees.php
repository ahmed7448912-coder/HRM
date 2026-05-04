<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'department_id',
        'salary',
        'joining_date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
