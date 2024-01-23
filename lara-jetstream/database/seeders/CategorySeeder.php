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
            'informatica' => "Categoria relacionada con la informatica",
            'programacion' => "Categoria relacionada con la programacion",
            'tecnologia' => "Categoria relacionada con la tecnologia",
            'lenguajes' => "Categoria relacionada con los lenguajes de programacion",
            'bases de datos' => "Categoria relacionada con las bases de datos",
            'servidores' => "Categoria relacionada con los servidores",
        ];

        foreach ($categorias as $nombre => $descripcion) {
            Category::create(compact('nombre', 'descripcion'));
        }
    }
}
