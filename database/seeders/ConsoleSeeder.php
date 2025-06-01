<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ConsoleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Основные консольные команды для новичков',
                'text' => 'Консоль в TF2 открывается клавишей ` (ё/~) и позволяет вводить команды для настройки игры. Вот несколько полезных:
                -fov_desired 90 — увеличивает угол обзора (полезно для Scout и Soldier).
                -hud_reloadscheme — перезагружает интерфейс, если он «сломался».
                -volume 0.5 — регулирует громкость (1 — максимум, 0 — без звука).
                -net_graph 1 — показывает FPS, пинг и загрузку сети.
                Для быстрой настройки можно создать автоэкзекутивный конфиг (autoexec.cfg), куда запишутся все ваши команды.',
                'type' => 'console',
                'user_id' => 1,
            ],
            [
                'title' => 'Команды для тренировки и отладки',
                'text' => 'Если вы хотите улучшить свои навыки, попробуйте эти команды:
                -sv_cheats 1 + impulse 101 — даёт все оружия и бесконечные патроны (работает только на локальном сервере).
                -bot_kick — удаляет всех ботов.
                -tf_damage_disablespread 1 — отключает случайный разброс пуль (удобно для тестирования урона).
                -mat_wireframe 1 — включает «каркасный» режим (видит хитбоксы).
                Для тренировки прыжков солдата или демомана можно использовать tf_bot_add 32, чтобы заполнить сервер ботами.',
                'type' => 'console',
                'user_id' => 1,
            ],
            [
                'title' => 'Секретные и забавные команды',
                'text' => 'Некоторые команды не несут практической пользы, но могут развлечь:
                -explode — ваш персонаж моментально умирает (в мультиплеере не работает).
                -taunt — запускает случайный таунт.
                -thirdperson — переключает камеру в вид от третьего лица.
                -ent_fire !picker sethealth 1000 — даёт выбранному объекту 1000 HP (только с читами).
                А ещё можно изменить цвет интерфейса через cl_hud_color R G B, где R, G, B — числа от 0 до 255. Попробуйте cl_hud_color 255 0 0 для красного HUD!',
                'type' => 'console',
                'user_id' => 1,
            ]

        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }


}
