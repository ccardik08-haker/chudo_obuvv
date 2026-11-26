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
        foreach (['admin', 'manager', 'user'] as $name) {
            Role::firstOrCreate(['name' => $name]);
        }

        $roleIds = Role::pluck('id', 'name');

        $users = [
            ['admin', 'admin', '+79000000000', 'admin'],
            ['manager', 'manager', '+79000000001', 'manager'],
            ['user', 'user', '+79000000002', 'user'],
            ['isivanov', 'isivanov', '+79000000003', 'admin'],
            ['papetrov', 'papetrov', '+79000000004', 'manager'],
            ['asidorova', 'asidorova', '+79000000005', 'user'],
            ['ekuznetsova', 'ekuznetsova', '+79000000006', 'manager'],
            ['dsmirnov', 'dsmirnov', '+79000000007', 'user'],
            ['apopov', 'apopov', '+79000000008', 'admin'],
            ['ovasileva', 'ovasileva', '+79000000009', 'user'],
            ['psokolov', 'psokolov', '+79000000010', 'manager'],
            ['tmikhailova', 'tmikhailova', '+79000000011', 'user'],
            ['nnovikova', 'nnovikova', '+79000000012', 'manager'],
            ['afedorov', 'afedorov', '+79000000013', 'admin'],
            ['smorozov', 'smorozov', '+79000000014', 'user'],
            ['jvolkova', 'jvolkova', '+79000000015', 'manager'],
            ['aalekseev', 'aalekseev', '+79000000016', 'user'],
            ['ilebedeva', 'ilebedeva', '+79000000017', 'user'],
            ['negorov', 'negorov', '+79000000018', 'manager'],
            ['epavlova', 'epavlova', '+79000000019', 'user'],
            ['rkozlov', 'rkozlov', '+79000000020', 'admin'],
            ['vstepanova', 'vstepanova', '+79000000021', 'manager'],
            ['vnikolaev', 'vnikolaev', '+79000000022', 'user'],
        ];

        foreach ($users as $u) {
            [$login, $emailPrefix, $phone, $roleName] = $u;

            User::firstOrCreate(
                ['login' => $login],
                [
                    'role_id'  => $roleIds[$roleName],
                    'phone'    => $phone,
                    'email'    => $emailPrefix . '@chudo.ru',
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}