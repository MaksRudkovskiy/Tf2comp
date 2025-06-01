<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@mail.ru')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@mail.ru',
                'password' => Hash::make('668822'),
                'role' => 1
            ]);

            $this->command->info('Администратор создан!');
        } else {
            $this->command->info('Администратор уже существует!');
        }
    }
}
