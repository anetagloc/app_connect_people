<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Sport & Aktywność fizyczna' => [
                'Siłownia',
                'Bieganie',
                'Joga',
                'Stretching',
                'Crossfit',
                'Rowery (szosowe, MTB, rekreacyjne)',
                'Wspinaczka (ścianka, bouldering)',
                'Pływanie',
                'Rolki',
                'Łyżwy',
                'Sporty rakietowe (tenis, badminton, squash)',
                'Siatkówka',
                'Koszykówka',
                'Piłka nożna',
                'Trening personalny we dwoje',
                'Hiking / leśne wędrówki',
                'Nordic walking',
                'Zumba / taniec fitness',
                'Fitness',
            ],
            'Gry & Rozrywka' => [
                'Planszówki (euro, imprezowe, strategiczne)',
                'RPG (np. Dungeons & Dragons)',
                'Gry wideo (co-op, konsola, PC, retro)',
                'Escape roomy',
                'Kręgle',
                'Bilard',
                'Darts',
                'Quizy pubowe',
                'Karcianki (MTG, Pokemon, klasyczne)',
            ],
            'Kultura & Sztuka' => [
                'Kino (premiery, arthouse)',
                'Teatr',
                'Stand-up',
                'Wystawy',
                'Galerie sztuki',
                'Muzea',
                'Koncerty (rock, jazz, klasyka, alternatywa)',
                'Festiwale',
                'Spotkania literackie',
                'Book club (wspólne czytanie)',
            ],
            'Kulinarne' => [
                'Wyjścia na kawę',
                'Wyjścia na śniadanie lub brunch',
                'Restauracje (kuchnia świata)',
                'Degustacje win',
                'Degustacje piw kraftowych',
                'Kolacje tematyczne',
                'Warsztaty kulinarne',
                'Wspólne gotowanie w domu',
                'Food truck tour',
                'Bubble tea, koktajle lub smoothie walk',
            ],
            'Fotografia & Twórcze hobby' => [
                'Fotografowanie w mieście',
                'Fotografia natury',
                'Fotografia portretowa',
                'Wspólne wyjście fotograficzne',
                'Rysowanie',
                'Malowanie',
                'Ceramika',
                'DIY i rękodzieło',
                'Muzyka (jam sessions, granie na instrumentach)',
                'Montaż wideo i tworzenie contentu',
            ],
            'Podróże & Outdoor' => [
                'Spacery po mieście',
                'Spacery po parkach',
                'Wycieczki jednodniowe',
                'Weekendy poza miastem',
                'Zwiedzanie lokalnych atrakcji',
                'Camping',
                'Ogniska',
                'Kajaki',
                'Wyjazdy w góry',
            ],
            'Lifestyle & Wellbeing' => [
                'Medytacja',
                'Saunowanie',
                'Morsowanie',
                'Wyjścia z psami',
            ],
            'Społeczność i lokalne inicjatywy' => [
                'Wolontariat',
                'Lokalne wydarzenia',
                'Targi i jarmarki',
                'Sąsiedzkie spacery',
                'Spotkania networkingowe',
                'Grupowe spotkania tematyczne',
            ],
        ];

        foreach ($data as $categoryName => $activities) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($activities as $activityName) {
                Activity::create([
                    'name' => $activityName,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
