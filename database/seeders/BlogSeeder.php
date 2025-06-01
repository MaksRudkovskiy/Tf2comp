<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        if (Section::where('type', 'blog')->count() >= 1) {
            $this->command->info('Блог уже просидирован!');
            return;
        }

        Section::create(
            [
                'title' => 'Всем привет!',
                'text' => 'Это начало блога на сайте!',
                'type' => 'blog',
                'user_id' => 1,
            ]
        );
    }
}
