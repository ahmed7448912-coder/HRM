<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function getAll()
    {
        return Role::with('permissions')->latest()->get();
    }

    public function create(array $data)
    {
        $role = Role::create([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? 'web',
        ]);

        $role->syncPermissions($data['permissions']);

        return $role;
    }

    public function update(Role $role, array $data)
    {
        $role->update([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? $role->guard_name,
        ]);

        $role->syncPermissions($data['permissions']);

        return $role;
    }

    public function delete(Role $role)
    {
        return $role->delete();
    }
}
