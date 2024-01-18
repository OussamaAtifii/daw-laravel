<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'informatica' => "#81D4FA",
            'paisaje' => "#FFF59D",
            'viajes' => "#FFAB91",
            'programacion' => "#EEEEEE",
            'ocio' => "#EF9A9A",
        ];

        foreach ($tags as $tag => $c) {
            Tag::create([
                'nombre' => $tag,
                'color' => $c,
            ]);
        }
    }
}
