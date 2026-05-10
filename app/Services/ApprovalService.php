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
                    <div class="dropdown text-end pe-3">
                        <button class="btn btn-light btn-sm rounded-pill shadow-sm border border-white dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-4">
                            <li>
                                <form action="' . route('admin.approvals.approve', $row) . '" method="POST" class="d-inline">
                                    ' . csrf_field() . '
                                    <button type="submit" class="dropdown-item py-2 text-success">
                                        <i class="bi bi-check-circle-fill me-2"></i> Approve User
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form action="' . route('admin.approvals.reject', $row) . '" method="POST" class="d-inline">
                                    ' . csrf_field() . '
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="bi bi-x-circle-fill me-2"></i> Reject User
                                    </button>
                                </form>
                            </li>
                        </ul>
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
