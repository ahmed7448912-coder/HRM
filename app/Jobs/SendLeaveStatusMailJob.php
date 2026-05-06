<?php

namespace App\Jobs;

use App\Mail\LeaveStatusMail;
use App\Models\Leave;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendLeaveStatusMailJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $leave;

    public function __construct(Leave $leave)
    {
        $this->leave = $leave;
    }


    public function handle()
    {
        Mail::to($this->leave->employee->email)
            ->send(new LeaveStatusMail($this->leave));
    }
}
