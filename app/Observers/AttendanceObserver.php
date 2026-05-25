<?php

namespace App\Observers;

use App\Models\Attendance;
use Illuminate\Support\Facades\Log;

class AttendanceObserver
{
    /**
     * Handle the Attendance "created" event.
     *
     * Fires when a new attendance record is saved for the first time.
     * e.g. employee checks in, or admin manually marks attendance,
     * or the scheduler creates an "absent" record at 23:59.
     */
    public function created(Attendance $attendance): void
    {
        $employeeName = $attendance->employee?->name ?? "Employee #{$attendance->employee_id}";
        $status       = $attendance->status ?? 'present';

        Log::info("Attendance CREATED — {$employeeName} | Date: {$attendance->date} | Status: {$status} | Check-in: {$attendance->check_in}");
    }

    /**
     * Handle the Attendance "updated" event.
     *
     * Fires when an existing attendance record is changed.
     * e.g. admin edits check-in/check-out time, or status changes from present → absent.
     * We detect late arrivals (check-in after 09:00) and log a warning.
     */
    public function updated(Attendance $attendance): void
    {
        $employeeName = $attendance->employee?->name ?? "Employee #{$attendance->employee_id}";

        // Log when the status field specifically changes (e.g. present → absent)
        if ($attendance->isDirty('status')) {
            $old = $attendance->getOriginal('status');
            $new = $attendance->status;

            Log::info("Attendance STATUS CHANGED — {$employeeName} | Date: {$attendance->date} | {$old} → {$new}");
        }

        // Detect late check-in: if check_in was just set and is after 09:00
        if ($attendance->isDirty('check_in') && $attendance->check_in) {
            $checkInTime  = \Carbon\Carbon::createFromFormat('H:i:s', $attendance->check_in);
            $workStartTime = \Carbon\Carbon::createFromFormat('H:i:s', '09:00:00');

            if ($checkInTime->gt($workStartTime)) {
                $minutesLate = $checkInTime->diffInMinutes($workStartTime);
                Log::warning("LATE ARRIVAL — {$employeeName} | Date: {$attendance->date} | Check-in: {$attendance->check_in} | {$minutesLate} minutes late.");
            }
        }

        // Log check-out time when it is recorded
        if ($attendance->isDirty('check_out') && $attendance->check_out) {
            Log::info("Check-out recorded — {$employeeName} | Date: {$attendance->date} | Check-out: {$attendance->check_out}");
        }
    }

    /**
     * Handle the Attendance "deleted" event.
     *
     * Fires when an attendance record is soft-deleted.
     * e.g. admin removes an incorrect attendance entry.
     */
    public function deleted(Attendance $attendance): void
    {
        $employeeName = $attendance->employee?->name ?? "Employee #{$attendance->employee_id}";

        Log::warning("Attendance DELETED — {$employeeName} | Date: {$attendance->date} | Status was: {$attendance->status}");
    }

    /**
     * Handle the Attendance "restored" event.
     *
     * Fires when a soft-deleted attendance record is restored.
     */
    public function restored(Attendance $attendance): void
    {
        $employeeName = $attendance->employee?->name ?? "Employee #{$attendance->employee_id}";

        Log::info("Attendance RESTORED — {$employeeName} | Date: {$attendance->date} | Status: {$attendance->status}");
    }

    /**
     * Handle the Attendance "force deleted" event.
     *
     * Fires when an attendance record is permanently removed from the database.
     */
    public function forceDeleted(Attendance $attendance): void
    {
        $employeeName = $attendance->employee?->name ?? "Employee #{$attendance->employee_id}";

        Log::warning("Attendance PERMANENTLY DELETED — {$employeeName} | Date: {$attendance->date}");
    }
}
