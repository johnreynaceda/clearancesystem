<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);
        User::create([
            'name' => 'School Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id
        ]);

        $role = Role::create(['name' => 'Adviser']);
        // User::create([
        //     'name' => 'Adviser',
        //     'email' => 'adviser@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role_id' => $role->id
        // ]);

        $role = Role::create(['name' => 'Subject Teacher']);
        // User::create([
        //     'name' => 'Subject Teacher',
        //     'email' => 'teacher@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role_id' => $role->id
        // ]);

        $role = Role::create(['name' => 'Student']);
        // User::create([
        //     'name' => 'Student',
        //     'email' => 'student@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role_id' => $role->id
        // ]);

    }
}
