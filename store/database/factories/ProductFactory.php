<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));
        $stock = random_int(0, 50);

        $stock = ($stock <= 10) ? 0 : $stock;

        return [
            'nombre' => fake()->unique()->word(random_int(2, 3), true),
            'descripcion' => fake()->text(),
            'stock' => $stock,
            'disponible' =>  $stock ? 'si' : 'no',
            'pvp' => fake()->randomFloat(2, 1, 9999.99),
            'user_id' => User::all()->random()->id,
            'imagen' => 'productos/' . fake()->picsum('public/storage/productos', 640, 480, false)
        ];
    }
}
