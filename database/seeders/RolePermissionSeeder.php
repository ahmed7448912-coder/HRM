<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // PERMISSIONS

        Permission::create(['name' => 'employee.view']);
        Permission::create(['name' => 'employee.create']);
        Permission::create(['name' => 'employee.edit']);
        Permission::create(['name' => 'employee.delete']);

        Permission::create(['name' => 'attendance.view']);
        Permission::create(['name' => 'attendance.manage']);

        Permission::create(['name' => 'leave.view']);
        Permission::create(['name' => 'leave.manage']);
        Permission::create(['name' => 'leave.approve']);

        Permission::create(['name' => 'payroll.view']);
        Permission::create(['name' => 'payroll.manage']);

        Permission::create(['name' => 'reports.view']);



        // ROLES

        $admin = Role::create(['name' => 'Admin']);

        $hr = Role::create(['name' => 'HR']);

        $employee = Role::create(['name' => 'Employee']);



        // ASSIGN PERMISSIONS

        $admin->givePermissionTo(Permission::all());



        $hr->givePermissionTo([
            'employee.view',
            'employee.create',
            'employee.edit',

            'attendance.view',
            'attendance.manage',

            'leave.view',
            'leave.manage',
            'leave.approve',

            'reports.view'
        ]);



        $employee->givePermissionTo([
            'employee.view'
        ]);
    }
}
