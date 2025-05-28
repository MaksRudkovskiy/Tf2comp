<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        Storage::makeDirectory('public/characters/default');

        $classes = [
            [
                'name' => 'Скаут',
                'description' => 'Быстрый наёмник с низким здоровьем. Специализируется на быстрых атаках и захвате точек.',
                'red_picture' => $this->copyDefaultImage('scout.png'),
            ],
            [
                'name' => 'Солдат',
                'description' => 'Универсальный боец с ракетницей. Отлично подходит для новичков и опытных игроков.',
                'red_picture' => $this->copyDefaultImage('soldier.png'),
            ],
            [
                'name' => 'Пиро',
                'description' => 'Эксперт по контролю территории с огнемётом. Может отражать снаряды сжатым воздухом.',
                'red_picture' => $this->copyDefaultImage('pyro.png'),
            ],
            [
                'name' => 'Дэмо',
                'description' => 'Специалист по взрывчатым веществам. Использует гранатомет и липкие бомбы.',
                'red_picture' => $this->copyDefaultImage('demo.png'),
            ],
            [
                'name' => 'Хэви',
                'description' => 'Тяжелый класс с большим запасом здоровья. Медленный, но мощный.',
                'red_picture' => $this->copyDefaultImage('heavy.png'),
            ],
            [
                'name' => 'Инженер',
                'description' => 'Строит оборонительные сооружения. Управляет турелью, раздатчиком и телепортом.',
                'red_picture' => $this->copyDefaultImage('engineer.png'),
            ],
            [
                'name' => 'Медик',
                'description' => 'Лечит союзников. Может дать неуязвимость на короткое время с помощью Уберзаряда.',
                'red_picture' => $this->copyDefaultImage('medic.png'),
            ],
            [
                'name' => 'Снайпер',
                'description' => 'Дальнобойный специалист. Убивает врагов с одного выстрела в голову.',
                'red_picture' => $this->copyDefaultImage('sniper.png'),
            ],
            [
                'name' => 'Шпион',
                'description' => 'Мастер скрытности. Может маскироваться под врагов и убивать с одного удара в спину.',
                'red_picture' => $this->copyDefaultImage('spy.png'),
            ]
        ];

        foreach ($classes as $class) {
            Character::create($class);
        }
    }

    private function copyDefaultImage(string $filename): string
    {
        $sourcePath = public_path("content/img/characters/{$filename}");
        $destPath = "characters/default/{$filename}";

        Storage::put("public/{$destPath}", file_get_contents($sourcePath));

        return $destPath;
    }
}
