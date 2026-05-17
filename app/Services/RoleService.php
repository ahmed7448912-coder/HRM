<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Spatie\Permission\Models\Role;

class RoleService
{
    protected $repo;

    public function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(Role $role, array $data)
    {
        return $this->repo->update($role, $data);
    }

    public function destroy(Role $role)
    {
        return $this->repo->delete($role);
    }
}
