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
            'Informatica' => 'Categoria relacionada con el mundo de la informatica',
            'Cine' => 'Categoria relacionada con el mundo de la cine',
            'Deporte' => 'Categoria relacionada con el mundo de la deporte',
            'Comida' => 'Categoria relacionada con el mundo de la comida',
        ];

        foreach ($categorias as $nombre => $descripcion) {
            Category::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion
            ]);
        }
    }
}
