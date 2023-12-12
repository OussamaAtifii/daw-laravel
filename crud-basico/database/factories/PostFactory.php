<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));

        return [
            'titulo' => ucfirst(fake()->unique->words(random_int(2, 3), true)),
            'contenido' => fake()->text(500),
            'publicado' => random_int(1, 2),
            'imagen' => 'posts/' . fake()->picsum('public/storage/posts/', 640, 480, false),
        ];
    }
}
