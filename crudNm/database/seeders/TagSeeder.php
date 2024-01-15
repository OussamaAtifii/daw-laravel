<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'informatica' => '#0000FF',
            'programacion' => '#FF0000',
            'tecnologia' => '#008000',
            'lenguajes' => '#FFFF00',
            'bases-de-datos' => '#800080',
            'servidores' => '#FFC0CB',
            'sistemas-operativos' => '#FFA500',
            'seguridad' => '#4B0082',
            'redes' => '#008080',
            'internet' => '#00FFFF',
            'diseno' => '#808080',
            'videojuegos' => '#00FF00',
            'moviles' => '#FFBF00',
            'electronica' => '#A52A2A',
        ];

        foreach ($tags as $tag => $c) {
            Tag::create([
                'nombre' => $tag,
                'color' => $c,
            ]);
        }
    }
}
