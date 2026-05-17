<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            /*
            |--------------------------------------------------------------------------
            | Employees
            |--------------------------------------------------------------------------
            */

            'employee.view',
            'employee.create',
            'employee.edit',
            'employee.delete',
            'employee.show',
            'employee.export',
            'employee.import',
            'employee.restore',
            'employee.forceDelete',
            'employee.changeRole',


            /*
            |--------------------------------------------------------------------------
            | Departments
            |--------------------------------------------------------------------------
            */

            'department.view',
            'department.create',
            'department.edit',
            'department.delete',
            'department.show',
            'department.export',
            'department.import',
            'department.restore',
            'department.forceDelete',
            'department.assignHead',


            /*
            |--------------------------------------------------------------------------
            | Attendance
            |--------------------------------------------------------------------------
            */

            'attendance.view',
            'attendance.create',
            'attendance.edit',
            'attendance.delete',
            'attendance.show',
            'attendance.mark',
            'attendance.bulkMark',
            'attendance.export',
            'attendance.import',
            'attendance.approve',


            /*
            |--------------------------------------------------------------------------
            | Leave
            |--------------------------------------------------------------------------
            */

            'leave.view',
            'leave.create',
            'leave.edit',
            'leave.delete',
            'leave.show',
            'leave.approve',
            'leave.reject',
            'leave.cancel',
            'leave.export',
            'leave.import',


            /*
            |--------------------------------------------------------------------------
            | Payroll
            |--------------------------------------------------------------------------
            */

            'payroll.view',
            'payroll.create',
            'payroll.edit',
            'payroll.delete',
            'payroll.show',
            'payroll.generate',
            'payroll.export',
            'payroll.sendEmail',
            'payroll.markPaid',
            'payroll.resendSlip',


            /*
            |--------------------------------------------------------------------------
            | Performance
            |--------------------------------------------------------------------------
            */

            'performance.view',
            'performance.create',
            'performance.edit',
            'performance.delete',
            'performance.show',
            'performance.review',
            'performance.rating',
            'performance.comment',
            'performance.export',
            'performance.import',


            /*
            |--------------------------------------------------------------------------
            | Reports
            |--------------------------------------------------------------------------
            */

            'reports.view',
            'reports.create',
            'reports.generate',
            'reports.export',
            'reports.download',
            'reports.employee',
            'reports.attendance',
            'reports.leave',
            'reports.payroll',
            'reports.performance',


            /*
            |--------------------------------------------------------------------------
            | Roles
            |--------------------------------------------------------------------------
            */

            'role.view',
            'role.create',
            'role.edit',
            'role.delete',
            'role.show',
            'role.assign',
            'role.permissions',
            'role.export',
            'role.import',
            'role.manage',


            /*
            |--------------------------------------------------------------------------
            | Users
            |--------------------------------------------------------------------------
            */

            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'user.show',
            'user.activate',
            'user.deactivate',
            'user.changePassword',
            'user.resetPassword',
            'user.export',


            /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */

            'settings.view',
            'settings.edit',
            'settings.company',
            'settings.smtp',
            'settings.logo',
            'settings.backup',
            'settings.restore',
            'settings.security',
            'settings.notification',
            'settings.system',


            /*
            |--------------------------------------------------------------------------
            | Salary
            |--------------------------------------------------------------------------
            */

            'salary.view',
            'salary.create',
            'salary.edit',
            'salary.delete',
            'salary.generate',
            'salary.pay',
            'salary.history',
            'salary.sendEmail',
            'salary.resendEmail',
            'salary.transactions',


            /*
            |--------------------------------------------------------------------------
            | Transactions
            |--------------------------------------------------------------------------
            */

            'transaction.view',
            'transaction.create',
            'transaction.edit',
            'transaction.delete',
            'transaction.show',
            'transaction.export',
            'transaction.import',
            'transaction.approve',
            'transaction.reject',
            'transaction.history',


            /*
            |--------------------------------------------------------------------------
            | Notifications
            |--------------------------------------------------------------------------
            */

            'notification.view',
            'notification.create',
            'notification.send',
            'notification.delete',
            'notification.email',
            'notification.sms',
            'notification.push',
            'notification.bulk',
            'notification.markRead',
            'notification.settings',


            /*
            |--------------------------------------------------------------------------
            | Dashboard
            |--------------------------------------------------------------------------
            */

            'dashboard.view',
            'dashboard.statistics',
            'dashboard.attendance',
            'dashboard.leave',
            'dashboard.payroll',
            'dashboard.performance',
            'dashboard.analytics',
            'dashboard.export',
            'dashboard.graphs',
            'dashboard.reports',

        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
