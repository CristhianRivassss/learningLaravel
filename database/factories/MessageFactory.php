<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Message::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefono' => fake()->phoneNumber(),
            'mensaje' => fake()->paragraph(),
            // 'user_id' => null, // si quieres asociar con un usuario, usa ->for(User::factory()) en tests
        ];
    }

    /**
     * Associate the message to a user.
     */
    public function withUser($user)
    {
        return $this->state(function (array $attributes) use ($user) {
            return ['user_id' => $user->id ?? $user];
        });
    }
}
