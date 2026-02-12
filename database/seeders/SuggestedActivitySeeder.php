<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\SuggestedActivity;
use Illuminate\Database\Seeder;

class SuggestedActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Losowo wybierz 15 unikalnych aktywności z tabeli activities
        $activityIds = Activity::inRandomOrder()
            ->limit(15)
            ->pluck('id');

        foreach ($activityIds as $activityId) {
            SuggestedActivity::create([
                'activity_id' => $activityId,
            ]);
        }
    }
}
