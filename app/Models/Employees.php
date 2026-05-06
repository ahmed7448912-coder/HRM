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
        'image',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
