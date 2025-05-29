<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class HistorySeeder extends Seeder
{
    public function run(): void
    {
        Article::create([
            'title' => 'Зарождение концептов TF2',
            'text' => 'Полный текст истории о создании TF2...',
            'type' => 'history'
        ]);
    }


}
