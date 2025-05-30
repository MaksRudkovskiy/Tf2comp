<?php

namespace Tests\Feature;

use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CharacterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_update_character_description()
    {
        // 1. Создание админа
        $admin = User::create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 1 // ADMIN
            // Не включаем email_verified_at и remember_token
        ]);

        // 2. Создание персонажа
        $character = Character::create([
            'name' => 'Скаут',
            'description' => 'Старое описание',
            'red_picture' => 'characters/default/scout.png',
            'user_id' => $admin->id
        ]);

        // 3. Админ пытается обновить описание
        $response = $this->actingAs($admin)
            ->put(route('admin.characters.update', $character), [
                'description' => 'Новое описание'
                // red_picture и blu_picture не обязательны для обновления
            ]);

        // 4. Проверяем результат
        $response->assertRedirect();
        $this->assertEquals('Новое описание', $character->fresh()->description);
    }
}
