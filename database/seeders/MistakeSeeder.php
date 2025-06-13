<?php

namespace Database\Seeders;

use App\Models\Mistake;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;

class MistakeSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем 50 случайных ошибок
        Mistake::factory()->count(50)->create();

    }
}
