<?php

namespace Tests\Feature;

use App\Models\Mistake;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MistakeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_submit_mistake_report()
    {
        // 1. Создаем пользователя
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'role' => 0
        ]);

        // 2. Отправляем запрос
        $response = $this->actingAs($user)
            ->post(route('mistakes.store'), [
                'text' => 'Обнаружена ошибка в описании персонажа'
            ]);

        // 3. Проверяем базовые вещи
        $response->assertRedirect();
        $response->assertSessionHas('status', 'error-reported');

        // 4. Проверяем сохранение в БД (без проверки даты)
        $this->assertDatabaseHas('mistakes', [
            'text' => 'Обнаружена ошибка в описании персонажа',
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        // 5. Альтернативная проверка даты
        $mistake = Mistake::first();
        $this->assertNotNull($mistake->date);
    }
}
