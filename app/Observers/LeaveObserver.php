<?php

namespace App\Observers;

use App\Jobs\SendLeaveStatusMailJob;
use App\Models\Leave;

class LeaveObserver
{
    /**
     * Handle the Leave "created" event.
     */
    public function created(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "updated" event.
     */
    public function updated(Leave $leave): void
    {
        // only run when status changes
        if ($leave->isDirty('status')) {

            dispatch(new SendLeaveStatusMailJob($leave));
        }
    }

    /**
     * Handle the Leave "deleted" event.
     */
    public function deleted(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "restored" event.
     */
    public function restored(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "force deleted" event.
     */
    public function forceDeleted(Leave $leave): void
    {
        //
    }
}
