<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rekanan>
 */
class RekananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $units = [
            'C301',
            'C302',
            'C303',
            'C304',
            'C305',
            'C306',
        ];

        $times = [
            '07:00:00',
            '15:00:00',
            '23:00:00',
        ];

        $open = fake()->randomElement($times);
        switch ($open) {
            case '07:00:00':
                $close = '15:00:00';
                break;
            case '15:00:00':
                $close = '23:00:00';
                break;
            case '23:00:00':
                $close = '07:00:00';
                break;
        }

        return [
            'nama' => fake()->name(),
            'telepon' => fake()->phoneNumber(),
            'unit' => fake()->randomElement($units),
            'item' => fake()->word(),
            'pekerjaan' => 'Repair Baseframe',
            'no_permit' => fake()->numberBetween(100000, 999999),
            'rekanan' => 'PT. US/PCS',
            'open' => $open,
            'close' => $close,
            'created_at' => fake()->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
