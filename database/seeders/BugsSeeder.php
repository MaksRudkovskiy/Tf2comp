<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BugsSeeder extends Seeder
{
    public function run()
    {
        Article::create([
            'title' => 'Секретные места на 2fort',
            'text' => 'Полный текст о секретных местах...',
            'type' => 'bug'
        ]);

    }

}
