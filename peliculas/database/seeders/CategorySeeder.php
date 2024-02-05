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
        $categories = [
            'Documental',
            'Ciencia Ficcion',
            'Anime',
            'Terror'
        ];

        foreach ($categories as $category) {
            Category::create(['nombre' => $category]);
        }
    }
}
