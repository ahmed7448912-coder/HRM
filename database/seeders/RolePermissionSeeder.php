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

        Permission::firstOrCreate(['name' => 'employee.view']);
        Permission::firstOrCreate(['name' => 'employee.create']);
        Permission::firstOrCreate(['name' => 'employee.edit']);
        Permission::firstOrCreate(['name' => 'employee.delete']);

        Permission::firstOrCreate(['name' => 'attendance.view']);
        Permission::firstOrCreate(['name' => 'attendance.manage']);

        Permission::firstOrCreate(['name' => 'leave.view']);
        Permission::firstOrCreate(['name' => 'leave.manage']);
        Permission::firstOrCreate(['name' => 'leave.approve']);

        Permission::firstOrCreate(['name' => 'payroll.view']);
        Permission::firstOrCreate(['name' => 'payroll.manage']);

        Permission::firstOrCreate(['name' => 'reports.view']);



        // ROLES

        $admin = Role::firstOrCreate(['name' => 'Admin']);

        $hr = Role::firstOrCreate(['name' => 'HR']);

        $employee = Role::firstOrCreate(['name' => 'Employee']);



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
