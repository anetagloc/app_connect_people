<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Kolejność jest ważna — tabele z FK muszą mieć dane w tabelach nadrzędnych:
     * 1. Categories (brak zależności)
     * 2. Activities (FK → categories)
     * 3. SuggestedActivities (FK → activities)
     * 4. Events (brak zależności)
     * 5. AvaibleTimes (brak zależności)
     * 6. Users (FK → events, activities, avaible_times)
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ActivitySeeder::class,
            SuggestedActivitySeeder::class,
            EventSeeder::class,
            AvaibleTimeSeeder::class,
        ]);

        // 100 fake users — tworzone po wszystkich tabelach,
        // bo UserFactory losuje event_id, activity_id, avaible_time_id
        User::factory(100)->create();
    }
}
