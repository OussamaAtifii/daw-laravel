<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Llamar al seeder de category para crear las categorias personalizadas
        $this->call(CategorySeeder::class);

        // Borrar el directo donde se van a guardar las imagnes y volver a crearlo
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        // Generar los posts mediante el factory de Post
        Post::factory(40)->create();
    }
}
