<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ModeratorSeeder extends Seeder
{
    public function run()
    {
        if (User::count() >= 3) {
            $this->command->info('Модераторы уже просидированыы!');
            return;
        }

        $moderators = [
            [
                'name' => 'Moderator1',
                'email' => 'moderator1@mail.ru',
                'password' => Hash::make('123123123'),
                'role' => User::ROLE_MODERATOR
            ],
            [
                'name' => 'Moderator2',
                'email' => 'moderator2@example.com',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_MODERATOR
            ],
            [
                'name' => 'Moderator3',
                'email' => 'moderator3@example.com',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_MODERATOR
            ]
        ];

        foreach ($moderators as $moderator) {
            User::create($moderator);
        }
    }
}
