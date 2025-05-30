<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        if (Item::count() > 0) {
            $this->command->info('Предметы уже просидированы!');
            return;
        }

        Storage::makeDirectory('public/items/default');

        $weapons = [
            // Скаут
            [
                'name' => 'Обрез',
                'caption' => 'Основное оружие Скаута',
                'description' => 'Дробовик с быстрой перезарядкой, но небольшим магазином.',
                'image_path' => $this->copyDefaultImage('scattergun.png'),
                'show_upside' => true,
                'upside' => 'Быстрая перезарядка',
                'show_downside' => true,
                'downside' => 'Малый магазин (6 патронов)',
                'characters' => ['Скаут']
            ],
            [
                'name' => 'Пистолет',
                'caption' => 'Вторичное оружие Скаута и Инженера',
                'description' => 'Стандартный пистолет с точным огнём на средней дистанции.',
                'image_path' => $this->copyDefaultImage('pistol.png'),
                'characters' => ['Скаут', 'Инженер']
            ],
            [
                'name' => 'Бита',
                'caption' => 'Ближний бой Скаута',
                'description' => 'Бейсбольная бита для ближнего боя.',
                'image_path' => $this->copyDefaultImage('bat.png'),
                'characters' => ['Скаут']
            ],

            // Солдат
            [
                'name' => 'Ракетомёт',
                'caption' => 'Основное оружие Солдата',
                'description' => 'Оружие, стреляющее ракетами, наносящими урон по площади.',
                'image_path' => $this->copyDefaultImage('rocket_launcher.png'),
                'characters' => ['Солдат']
            ],
            [
                'name' => 'Дробовик',
                'caption' => 'Вторичное оружие Солдата, Пиро, Хэви и Инженера',
                'description' => 'Стандартный дробовик с разбросом дроби.',
                'image_path' => $this->copyDefaultImage('shotgun.png'),
                'characters' => ['Солдат', 'Пиро', 'Хэви', 'Инженер']
            ],
            [
                'name' => 'Лопата',
                'caption' => 'Ближний бой Солдата',
                'description' => 'Стандартная сапёрная лопата для ближнего боя.',
                'image_path' => $this->copyDefaultImage('shovel.png'),
                'characters' => ['Солдат']
            ],

            // Пиро
            [
                'name' => 'Огнемёт',
                'caption' => 'Основное оружие Пиро',
                'description' => 'Струя огня, поджигающая врагов и наносящая периодический урон.',
                'image_path' => $this->copyDefaultImage('flame_thrower.png'),
                'characters' => ['Пиро']
            ],
            [
                'name' => 'Топор',
                'caption' => 'Ближний бой Пиро',
                'description' => 'Топор для ближнего боя, наносящий стандартный урон.',
                'image_path' => $this->copyDefaultImage('fire_axe.png'),
                'characters' => ['Пиро']
            ],

            // Демоман
            [
                'name' => 'Гранатомёт',
                'caption' => 'Основное оружие Демомана',
                'description' => 'Стреляет гранатами, которые отскакивают от поверхностей.',
                'image_path' => $this->copyDefaultImage('grenade_launcher.png'),
                'characters' => ['Дэмо']
            ],
            [
                'name' => 'Липучкомёт',
                'caption' => 'Вторичное оружие Демомана',
                'description' => 'Стреляет липкими бомбами, которые можно детонировать.',
                'image_path' => $this->copyDefaultImage('stickybomb_launcher.png'),
                'characters' => ['Дэмо']
            ],
            [
                'name' => 'Бутылка',
                'caption' => 'Ближний бой Демомана',
                'description' => 'Разбитая бутылка для ближнего боя.',
                'image_path' => $this->copyDefaultImage('bottle.png'),
                'characters' => ['Дэмо']
            ],

            // Хэви
            [
                'name' => 'Пулемёт',
                'caption' => 'Основное оружие Хэви',
                'description' => 'Мощный пулемёт с большим разбросом при стрельбе.',
                'image_path' => $this->copyDefaultImage('minigun.png'),
                'characters' => ['Хэви']
            ],
            [
                'name' => 'Кулаки',
                'caption' => 'Ближний бой Хэви',
                'description' => 'Стандартные кулаки для ближнего боя.',
                'image_path' => $this->copyDefaultImage('fists.png'),
                'characters' => ['Хэви']
            ],

            // Инженер
            [
                'name' => 'Гаечный ключ',
                'caption' => 'Ближний бой Инженера',
                'description' => 'Используется для постройки и ремонта зданий.',
                'image_path' => $this->copyDefaultImage('wrench.png'),
                'characters' => ['Инженер']
            ],

            // Медик
            [
                'name' => 'Шприцемёт',
                'caption' => 'Основное оружие Медика',
                'description' => 'Стреляет шприцами с лекарством, наносящими урон врагам.',
                'image_path' => $this->copyDefaultImage('syringe_gun.png'),
                'characters' => ['Медик']
            ],
            [
                'name' => 'Медпистолет',
                'caption' => 'Вторичное оружие Медика',
                'description' => 'Лечит союзников и заряжает уберзаряд.',
                'image_path' => $this->copyDefaultImage('medigun.png'),
                'characters' => ['Медик']
            ],
            [
                'name' => 'Пила',
                'caption' => 'Ближний бой Медика',
                'description' => 'Хирургическая пила для ближнего боя.',
                'image_path' => $this->copyDefaultImage('bonesaw.png'),
                'characters' => ['Медик']
            ],

            // Снайпер
            [
                'name' => 'Снайперская винтовка',
                'caption' => 'Основное оружие Снайпера',
                'description' => 'Позволяет убивать врагов с одного выстрела в голову при полном заряде.',
                'image_path' => $this->copyDefaultImage('sniper_rifle.png'),
                'characters' => ['Снайпер']
            ],
            [
                'name' => 'SMG',
                'caption' => 'Вторичное оружие Снайпера',
                'description' => 'Пистолет-пулемёт для самообороны на ближней дистанции.',
                'image_path' => $this->copyDefaultImage('smg.png'),
                'characters' => ['Снайпер']
            ],
            [
                'name' => 'Кукри',
                'caption' => 'Ближний бой Снайпера',
                'description' => 'Непальский нож для ближнего боя.',
                'image_path' => $this->copyDefaultImage('kukri.png'),
                'characters' => ['Снайпер']
            ],

            // Шпион
            [
                'name' => 'Револьвер',
                'caption' => 'Основное оружие Шпиона',
                'description' => 'Точный револьвер с высоким уроном в голову.',
                'image_path' => $this->copyDefaultImage('revolver.png'),
                'characters' => ['Шпион']
            ],
            [
                'name' => 'Жучок',
                'caption' => 'Вторичное оружие Шпиона',
                'description' => 'Позволяет Шпиону маскироваться под врагов.',
                'image_path' => $this->copyDefaultImage('sapper.png'),
                'characters' => ['Шпион']
            ],
            [
                'name' => 'Нож',
                'caption' => 'Ближний бой Шпиона',
                'description' => 'Убивает врагов мгновенно при ударе в спину.',
                'image_path' => $this->copyDefaultImage('knife.png'),
                'characters' => ['Шпион']
            ]
        ];

        foreach ($weapons as $weapon) {
            $item = Item::create([
                'name' => $weapon['name'],
                'caption' => $weapon['caption'],
                'description' => $weapon['description'],
                'image_path' => $weapon['image_path'],
                'show_upside' => $weapon['show_upside'] ?? false,
                'upside' => $weapon['upside'] ?? null,
                'show_downside' => $weapon['show_downside'] ?? false,
                'downside' => $weapon['downside'] ?? null,
            ]);

            // Привязываем персонажей
            $characterIds = Character::whereIn('name', $weapon['characters'])->pluck('id');
            $item->characters()->sync($characterIds);
        }
    }

    private function copyDefaultImage(string $filename): string
    {
        $source = public_path("content/img/items/{$filename}");
        $dest = "items/default/{$filename}";

        File::copy($source, public_path("storage/{$dest}"));

        return $dest; // Возвращаем относительный путь
    }
}
