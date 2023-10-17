<?php

namespace Database\Seeders;

use App\Models\RekapAbsen;
use App\Models\User;
use Illuminate\Database\Seeder;

class RekapAbsenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for each user create 20 rekap absen with date from 1 month ago until now
        User::all()->each(function ($user) {
            $date = now()->subMonth();
            $endDate = now();

            while ($date->lte($endDate)) {
                if ($date->isWeekend() || rand(1, 10) <= 4) {
                    $date->addDay();
                    continue;
                }

                RekapAbsen::factory()->create([
                    'user_id' => $user->id,
                    'tanggal' => $date->format('Y-m-d'),
                ]);
                $date->addDay();
            }
        });
    }
}
