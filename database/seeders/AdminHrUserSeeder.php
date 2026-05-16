<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminHrUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // =========================
        // ADMIN USER
        // =========================

        $admin = User::updateOrCreate(
            ['email' => 'ahmed7448912@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );

        $admin->syncRoles(['Admin']);


        // =========================
        // HR USER
        // =========================

        $hr = User::updateOrCreate(
            ['email' => 'ourtv.wm@gmail.com'],
            [
                'name' => 'HR',
                'password' => bcrypt('password'),
            ]
        );

        $hr->syncRoles(['HR']);
    }
}
