<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RekapAbsen>
 */
class RekapAbsenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'checkin_id' => null,
            'checkout_id' => null,
            'user_id' => User::all()->random()->id,
            'tanggal' => fake()->dateTimeBetween('-1 week', 'now')->format('Y-m-d'),
            'shift' => fake()->randomElement(['pagi', 'siang', 'malam']),
            'catatan' => null,
        ];
    }
}
