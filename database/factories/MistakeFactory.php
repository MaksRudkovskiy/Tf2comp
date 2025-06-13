<?php

namespace Database\Factories;

use App\Models\Mistake;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MistakeFactory extends Factory
{
    protected $model = Mistake::class;

    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-1 month', 'now');

        return [
            'text' => $this->generateMistakeText(),
            'status' => $this->faker->randomElement(['declined', 'pending', 'acknowledged', 'fixed']),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    protected function generateMistakeText(): string
    {
        $mistakes = [
            'В статье про {} указана неверная информация о {}, на самом деле {}',
            'Обнаружена ошибка в описании {}, правильный вариант: {}',
            'В разделе {} нужно исправить: {}',
            'Не соответствует действительности: {}, верно: {}',
            'Устаревшая информация о {}, актуальные данные: {}',
            'Неточность в описании {}: {}',
        ];

        $topics = [
            'режиме "Царь горы"', 'классе "Снайпер"', 'карте "Dustbowl"',
            'оружии "Rocket Launcher"', 'предмете "Gunslinger"', 'консольных командах',
            'настройках графики', 'системе подбора игроков', 'механиках передвижения',
        ];

        $details = [
            'таймер составляет 5 минут вместо 3',
            'урон составляет 150 вместо 100',
            'радиус эффекта 256 единиц вместо 128',
            'это работает только на некоторых картах',
            'это было изменено в обновлении 2023 года',
            'это зависит от настроек сервера',
        ];

        $text = $this->faker->randomElement($mistakes);
        $text = str_replace('{}', $this->faker->randomElement($topics), $text);
        $text = str_replace('{}', $this->faker->randomElement($details), $text);
        $text = str_replace('{}', $this->faker->randomElement($details), $text);

        return $text;
    }
}
