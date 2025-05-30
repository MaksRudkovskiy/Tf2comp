<?php

namespace Database\Seeders;
use App\Models\Article;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            AdminSeeder::class,
            CharacterSeeder::class,
            HistorySeeder::class,
            BugsSeeder::class,
            ChangesSeeder::class,
            BlogSeeder::class,
            ModeratorSeeder::class,
            ItemSeeder::class,
        ]);


    }
}
