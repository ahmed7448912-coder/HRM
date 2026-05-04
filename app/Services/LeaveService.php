<?php

namespace App\Services;

use App\Models\Leave;
use App\Repositories\LeaveRepository;

class LeaveService
{
    public function __construct(private LeaveRepository $repo) {}

    public function all()
    {
        return $this->repo->all();
    }

    public function apply(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(Leave $leave, array $data)
    {
        return $this->repo->update($leave, $data);
    }

    public function delete(Leave $leave)
    {
        return $this->repo->delete($leave);
    }

    public function updateStatus(Leave $leave, string $status)
    {
        return $this->repo->update($leave, ['status' => $status]);
    }
}
