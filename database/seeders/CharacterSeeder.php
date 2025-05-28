<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            [
                'name' => 'Скаут',
                'description' => 'Быстрый наёмник с низким здоровьем. Специализируется на быстрых атаках и захвате точек.',
                'red_picture' => "content/img/characters/scout.png",
            ],
            [
                'name' => 'Солдат',
                'description' => 'Универсальный боец с ракетницей. Отлично подходит для новичков и опытных игроков.',
                'red_picture' => "content/img/characters/soldier.png",
            ],
            [
                'name' => 'Пиро',
                'description' => 'Эксперт по контролю территории с огнемётом. Может отражать снаряды сжатым воздухом.',
                'red_picture' => "content/img/characters/pyro.png"
            ],
            [
                'name' => 'Дэмо',
                'description' => 'Специалист по взрывчатым веществам. Использует гранатомет и липкие бомбы.',
                'red_picture' => "content/img/characters/demo.png"
            ],
            [
                'name' => 'Хэви',
                'description' => 'Тяжелый класс с большим запасом здоровья. Медленный, но мощный.',
                'red_picture' => "content/img/characters/heavy.png"
            ],
            [
                'name' => 'Инженер',
                'description' => 'Строит оборонительные сооружения. Управляет турелью, раздатчиком и телепортом.',
                'red_picture' => "content/img/characters/engineer.png",
            ],
            [
                'name' => 'Медик',
                'description' => 'Лечит союзников. Может дать неуязвимость на короткое время с помощью Уберзаряда.',
                'red_picture' => "content/img/characters/medic.png"
            ],
            [
                'name' => 'Снайпер',
                'description' => 'Дальнобойный специалист. Убивает врагов с одного выстрела в голову.',
                'red_picture' => "content/img/characters/sniper.png"
            ],
            [
                'name' => 'Шпион',
                'description' => 'Мастер скрытности. Может маскироваться под врагов и убивать с одного удара в спину.',
                'red_picture' => "content/img/characters/spy.png"
            ]
        ];

        foreach ($classes as $class) {
            Character::create($class);
        }
    }
}
