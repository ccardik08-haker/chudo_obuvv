<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Создаем роли
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $userRole = Role::create(['name' => 'user']);

        // 2. Пользователи из Excel (логины и роли)
        $users = [
            ['lastname' => 'Иванов', 'firstname' => 'Иван', 'login' => 'isivanov', 'role' => $adminRole->id],
            ['lastname' => 'Петров', 'firstname' => 'Пётр', 'login' => 'papetrov', 'role' => $managerRole->id],
            ['lastname' => 'Сидорова', 'firstname' => 'Анна', 'login' => 'asidorova', 'role' => $userRole->id],
            ['lastname' => 'Кузнецова', 'firstname' => 'Екатерина', 'login' => 'ekuznetsova', 'role' => $managerRole->id],
            ['lastname' => 'Смирнов', 'firstname' => 'Дмитрий', 'login' => 'dsmirnov', 'role' => $userRole->id],
            ['lastname' => 'Попов', 'firstname' => 'Алексей', 'login' => 'apopov', 'role' => $adminRole->id],
            ['lastname' => 'Васильева', 'firstname' => 'Ольга', 'login' => 'ovasileva', 'role' => $userRole->id],
            ['lastname' => 'Соколов', 'firstname' => 'Павел', 'login' => 'psokolov', 'role' => $managerRole->id],
            ['lastname' => 'Михайлова', 'firstname' => 'Татьяна', 'login' => 'tmikhailova', 'role' => $userRole->id],
            ['lastname' => 'Новикова', 'firstname' => 'Наталья', 'login' => 'nnovikova', 'role' => $managerRole->id],
            ['lastname' => 'Фёдоров', 'firstname' => 'Андрей', 'login' => 'afedorov', 'role' => $adminRole->id],
            ['lastname' => 'Морозов', 'firstname' => 'Сергей', 'login' => 'smorozov', 'role' => $userRole->id],
            ['lastname' => 'Волкова', 'firstname' => 'Юлия', 'login' => 'jvolkova', 'role' => $managerRole->id],
            ['lastname' => 'Алексеев', 'firstname' => 'Артём', 'login' => 'aalekseev', 'role' => $userRole->id],
            ['lastname' => 'Лебедева', 'firstname' => 'Ирина', 'login' => 'ilebedeva', 'role' => $userRole->id],
            ['lastname' => 'Егоров', 'firstname' => 'Никита', 'login' => 'negorov', 'role' => $managerRole->id],
            ['lastname' => 'Павлова', 'firstname' => 'Елена', 'login' => 'epavlova', 'role' => $userRole->id],
            ['lastname' => 'Козлов', 'firstname' => 'Роман', 'login' => 'rkozlov', 'role' => $adminRole->id],
            ['lastname' => 'Степанова', 'firstname' => 'Виктория', 'login' => 'vstepanova', 'role' => $managerRole->id],
            ['lastname' => 'Николаев', 'firstname' => 'Владимир', 'login' => 'vnikolaev', 'role' => $userRole->id],
        ];

        foreach ($users as $u) {
            User::create([
                'role_id' => $u['role'],
                'login' => $u['login'],
                'phone' => '+7' . rand(900, 999) . rand(1000000, 9999999),
                'email' => $u['login'] . '@chudo.ru',
                'password' => Hash::make('password'), // Пароль для всех: password
            ]);
        }
    }
}