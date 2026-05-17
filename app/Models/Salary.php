<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'employee_id',
        'amount',
        'month',
        'status',
        'paid_at',
        'payment_reference',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }

    public function transactions()
    {
        return $this->hasMany(SalaryTransaction::class);
    }
}
