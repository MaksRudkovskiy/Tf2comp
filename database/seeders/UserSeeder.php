<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем администратора
        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@tf2guide.com',
        ]);

        // Создаем несколько модераторов
        User::factory()->count(3)->moderator()->create();

        // Создаем 100 обычных пользователей
        User::factory()->count(100)->create();
    }
}
