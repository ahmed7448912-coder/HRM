<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryTransaction extends Model
{
    protected $fillable = [
        'salary_id',
        'transaction_id',
        'amount',
        'payment_method',
        'status',
        'email_sent_at',
        'email_sent_to',
        'stripe_response',
        'currency',
    ];

    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    protected $casts = [
        'stripe_response' => 'array',
        'email_sent_at' => 'datetime',
    ];
}
