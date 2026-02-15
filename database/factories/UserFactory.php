<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\AvaibleTime;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => substr(fake()->unique()->userName(), 0, 16),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'create_time' => fake()->dateTimeBetween('-1 year', 'now'),
            'location_id' => fake()->numberBetween(1, 100),
            'age' => (string) fake()->numberBetween(18, 65),
            'description' => substr(fake()->sentence(3), 0, 45),
            'event_id' => fn () => Event::inRandomOrder()->value('id'),
            'activity_id' => fn () => Activity::inRandomOrder()->value('id'),
            'avaible_time_id' => fn () => AvaibleTime::inRandomOrder()->value('id'),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
