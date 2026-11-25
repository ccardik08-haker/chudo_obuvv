<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $user = Role::create(['name' => 'user']);

        User::create([
            'role_id' => $admin->id,
            'login' => 'admin',
            'phone' => '+70000000000',
            'email' => 'admin@chudo.ru',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'role_id' => $manager->id,
            'login' => 'manager',
            'phone' => '+70000000001',
            'email' => 'manager@chudo.ru',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'role_id' => $user->id,
            'login' => 'user',
            'phone' => '+70000000002',
            'email' => 'user@chudo.ru',
            'password' => Hash::make('password'),
        ]);
    }
}