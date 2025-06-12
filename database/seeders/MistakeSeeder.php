<?php

namespace Database\Seeders;

use App\Models\Mistake;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MistakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mistakes = [
            [
                'text' => 'В режиме царя горы не всегда таймер 3 минуты у каждой команды, он может зависеть от карты.',
                'status' => 'pending',
                'user_id' => 1,
                'created_at' => '2025-06-01 10:51:46',
            ],
            [
                'text' => 'В статье про консольных команд про поле зрения fov_desired самое оптимальное 80',
                'status' => 'accepted',
                'user_id' => 2,
                'created_at' => '2025-06-02 10:51:46',
            ],
            [
                'text' => 'Скаут это самый не крутой класс. Он вообще воняет, фу',
                'status' => 'declined',
                'user_id' => 3,
                'created_at' => '2025-06-03 10:51:46',
            ],
            [
                'text' => 'В режиме царя горы не всегда таймер 3 минуты у каждой команды, он может зависеть от карты.',
                'status' => 'pending',
                'user_id' => 1,
                'created_at' => '2025-05-21 10:51:46',
            ],
            [
                'text' => 'В статье про консольных команд про поле зрения fov_desired самое оптимальное 80',
                'status' => 'accepted',
                'user_id' => 2,
                'created_at' => '2025-05-24 10:51:46',
            ],
            [
                'text' => 'Скаут это самый не крутой класс. Он вообще воняет, фу',
                'status' => 'declined',
                'user_id' => 3,
                'created_at' => '2025-04-28 10:51:46',
            ],
        ];

        foreach ($mistakes as $mistake) {
            Mistake::create($mistake);
        }
    }
}
