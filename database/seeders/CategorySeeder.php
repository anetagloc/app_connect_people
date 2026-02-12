<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Sport & Aktywność fizyczna',
            'Gry & Rozrywka',
            'Kultura & Sztuka',
            'Kulinarne',
            'Fotografia & Twórcze hobby',
            'Podróże & Outdoor',
            'Lifestyle & Wellbeing',
            'Społeczność i lokalne inicjatywy',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
