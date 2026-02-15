<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventNames = [
            'Bieg charytatywny',
            'Turniej siatkówki plażowej',
            'Nocne zwiedzanie miasta',
            'Festiwal food trucków',
            'Wieczór planszówek',
            'Yoga w parku',
            'Maraton filmowy',
            'Jarmark rzemiosła',
            'Potańcówka retro',
            'Turniej szachowy',
            'Rajd rowerowy',
            'Warsztaty ceramiki',
            'Spotkanie book clubu',
            'Wieczór stand-upowy',
            'Piknik sąsiedzki',
            'Bieg z przeszkodami',
            'Wieczór karaoke',
            'Spływ kajakowy',
            'Dzień wolontariatu',
            'Turniej tenisa',
            'Koncert w parku',
            'Warsztaty fotograficzne',
            'Noc muzeów',
            'Targi startupów',
            'Wspólne morsowanie',
            'Wieczór degustacji win',
            'Turniej kręgli',
            'Escape room challenge',
            'Spotkanie networkingowe IT',
            'Ognisko integracyjne',
            'Turniej badmintona',
            'Wycieczka górska',
            'Warsztaty gotowania azjatyckiego',
            'Silent disco',
            'Festiwal kolorów',
        ];

        $cities = [
            'Warszawa', 'Kraków', 'Wrocław', 'Poznań', 'Gdańsk',
            'Łódź', 'Katowice', 'Lublin', 'Szczecin', 'Bydgoszcz',
            'Białystok', 'Toruń', 'Rzeszów', 'Opole', 'Kielce',
        ];

        return [
            'name' => substr(fake()->randomElement($eventNames), 0, 45),
            'location' => substr(fake()->randomElement($cities), 0, 45),
            'date' => fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'max_participants' => fake()->numberBetween(2, 50),
        ];
    }
}
