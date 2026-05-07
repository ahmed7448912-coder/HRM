<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = [
        'employee_id',
        'rating',
        'review',
        'review_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }
}
