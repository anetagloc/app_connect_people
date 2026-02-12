<?php

namespace Database\Seeders;

use App\Models\AvaibleTime;
use Illuminate\Database\Seeder;

class AvaibleTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Godziny od 0:00 do 24:00 (co godzinę = 25 rekordów)
        for ($hour = 0; $hour <= 24; $hour++) {
            AvaibleTime::create([
                'name' => sprintf('%02d:00', $hour),
            ]);
        }
    }
}
