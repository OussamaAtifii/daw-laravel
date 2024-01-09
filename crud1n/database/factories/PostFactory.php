<?php

namespace Database\Factories;

use App\Models\Category;
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
        // Añadir mmo provider de faker
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));

        return [
            'titulo' => fake()->unique()->sentence(),
            'contenido' => fake()->text(),
            'publicado' => random_int(1, 2),
            'imagen' => 'posts/' . fake()->picsum('public/storage/posts', 640, 480, false),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
