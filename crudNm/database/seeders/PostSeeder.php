<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los posts
        $posts = Post::factory(50)->create();

        // Asignar numero aleatorio de tags a cada post
        foreach ($posts as $post) {
            $post->tags()->attach($this->getRandomTagId());
        }
    }

    private function getRandomTagId(): array
    {
        $tags = [];
        $arrayTagsId = Tag::pluck('id')->toArray();
        $indices = array_rand($arrayTagsId, random_int(2, count($arrayTagsId)));

        foreach ($indices as $indice) {
            $tags[] = $arrayTagsId[$indice];
        }

        return $tags;
    }
}
