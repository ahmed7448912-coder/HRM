<?php

namespace App\Services;

use App\Models\Department;
use App\Repositories\DepartmentRepository;

class DepartmentService
{
    protected $repo;

    public function __construct(DepartmentRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(Department $department, array $data)
    {
        return $this->repo->update($department, $data);
    }

    public function delete(Department $department)
    {
        return $this->repo->delete($department);
    }
}
