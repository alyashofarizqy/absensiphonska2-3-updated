<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administator',
            'nik' => '1234567890',
            'email' => 'administrator@example.com',
            'role' => 'admin',
        ]);

        User::factory()->count(50)->create();

        $this->call(RekananSeeder::class);
        $this->call(RekapAbsenSeeder::class);
    }
}
