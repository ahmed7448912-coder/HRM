<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ApprovalService;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    protected $service;

    public function __construct(ApprovalService $service)
    {
        $this->service = $service;
    }

    /**
     * Show pending users for Admin approval.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getDatatable();
        }

        return view('admin.approvals.index');
    }

    /**
     * Approve a user.
     */
    public function approve(User $user)
    {
        $this->service->approve($user);
        return back()->with('success', "User {$user->name} has been approved.");
    }

    /**
     * Reject a user.
     */
    public function reject(User $user)
    {
        $this->service->reject($user);
        return back()->with('success', "User {$user->name} has been rejected.");
    }
}
