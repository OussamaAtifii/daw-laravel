<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Anime' => "Posts relacionados con el mundo Mangaca",
            'Juegos' => "Posts relacionados con el mundo de los videojuegos",
            'Deporte' => "Posts relacionados con el mundo del deporte",
            'Fotografias' => "Posts relacionados con el mundo de la fotografia"
        ];

        foreach ($categorias as $nombre => $descripcion) {
            Category::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion
            ]);
        }
    }
}
