<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-1 month', 'now');

        return [
            'name' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'avatar' => null,
            'role' => User::ROLE_USER,
            'is_banned' => $this->faker->boolean(10), // 10% chance of being banned
            'ban_reason' => $this->faker->boolean(30) ? $this->faker->sentence() : null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => User::ROLE_ADMIN,
            'is_banned' => false,
            'ban_reason' => null,
        ]);
    }

    public function moderator(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => User::ROLE_MODERATOR,
            'is_banned' => false,
            'ban_reason' => null,
        ]);
    }
}
