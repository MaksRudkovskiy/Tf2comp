<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Проверяем, существует ли уже админ
        if (!User::where('email', 'admin@tf2compendium.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@tf2compendium.com',
                'password' => Hash::make('123123123'), // Замените на надежный пароль
                'role' => 1
            ]);

            $this->command->info('Администратор создан!');
        } else {
            $this->command->info('Администратор уже существует!');
        }
    }
}
