<?php

namespace App\Services;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class ApprovalService
{
    /**
     * Get DataTables for pending users.
     */
    public function getDatatable()
    {
        $users = User::where('status', 'pending')->latest();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('user_details', function ($row) {
                $initial = strtoupper(substr($row->name, 0, 1));
                return '
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle me-3" style="width: 32px; height: 32px; background: #f1f5f9; color: #475569; font-size: 12px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                            ' . $initial . '
                        </div>
                        <div class="fw-semibold text-dark">' . $row->name . '</div>
                    </div>';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('M d, Y h:i A');
            })
            ->addColumn('actions', function ($row) {
                return '
                    <div class="d-flex justify-content-end gap-2">
                        <form action="' . route('admin.approvals.approve', $row) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm" style="font-size: 11px;">
                                <i class="bi bi-check-lg me-1"></i> Approve
                            </button>
                        </form>
                        <form action="' . route('admin.approvals.reject', $row) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm" style="font-size: 11px;">
                                <i class="bi bi-x-lg me-1"></i> Reject
                            </button>
                        </form>
                    </div>';
            })
            ->rawColumns(['user_details', 'actions'])
            ->make(true);
    }

    /**
     * Approve a user.
     */
    public function approve(User $user)
    {
        return $user->update(['status' => 'approved']);
    }

    /**
     * Reject a user.
     */
    public function reject(User $user)
    {
        return $user->update(['status' => 'rejected']);
    }
}
