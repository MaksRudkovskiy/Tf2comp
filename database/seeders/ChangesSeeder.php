<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Section;

class ChangesSeeder extends Seeder
{
    public function run(): void
    {
        if (Section::where('type', 'changelog')->count() >= 1) {
            $this->command->info('Изменения уже просидированы!');
            return;
        }

        Section::create(
            [
                'title' => 'V1.0',
                'text' => 'Справочник',
                'type' => 'changelog',
                'user_id' => 1,
            ]
        );
    }
}
