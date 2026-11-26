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
        $roles = [
            'admin'   => 'Администратор',
            'manager' => 'Менеджер',
            'user'    => 'Пользователь',
        ];

        foreach ($roles as $name) {
            Role::firstOrCreate(['name' => $name]);
        }

        $roleIds = Role::pluck('id', 'name'); // ['admin' => 1, 'manager' => 2, ...]

        $users = [
            ['Иванов', 'Иван', 'isivanov', 'admin'],
            ['Петров', 'Пётр', 'papetrov', 'manager'],
            ['Сидорова', 'Анна', 'asidorova', 'user'],
            ['Кузнецова', 'Екатерина', 'ekuznetsova', 'manager'],
            ['Смирнов', 'Дмитрий', 'dsmirnov', 'user'],
            ['Попов', 'Алексей', 'apopov', 'admin'],
            ['Васильева', 'Ольга', 'ovasileva', 'user'],
            ['Соколов', 'Павел', 'psokolov', 'manager'],
            ['Михайлова', 'Татьяна', 'tmikhailova', 'user'],
            ['Новикова', 'Наталья', 'nnovikova', 'manager'],
            ['Фёдоров', 'Андрей', 'afedorov', 'admin'],
            ['Морозов', 'Сергей', 'smorozov', 'user'],
            ['Волкова', 'Юлия', 'jvolkova', 'manager'],
            ['Алексеев', 'Артём', 'aalekseev', 'user'],
            ['Лебедева', 'Ирина', 'ilebedeva', 'user'],
            ['Егоров', 'Никита', 'negorov', 'manager'],
            ['Павлова', 'Елена', 'epavlova', 'user'],
            ['Козлов', 'Роман', 'rkozlov', 'admin'],
            ['Степанова', 'Виктория', 'vstepanova', 'manager'],
            ['Николаев', 'Владимир', 'vnikolaev', 'user'],
        ];

        foreach ($users as $i => $u) {
            [$lastname, $firstname, $login, $roleName] = $u;

            $phone = '+79' . str_pad((string) ($i + 1), 9, '0', STR_PAD_LEFT);

            User::firstOrCreate(
                ['login' => $login],
                [
                    'role_id' => $roleIds[$roleName],
                    'phone'   => $phone,
                    'email'   => $login . '@chudo.ru',
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}