<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));

        $posts = Post::factory(10)->create();

        foreach ($posts as $post) {
            $post->image()->create([
                'url_imagen' => 'imagenes/' . fake()->picsum('public/storage/imagenes', 400, 400, false),
                'desc_imagen' => fake()->sentence(),
            ]);
        }
    }
}
