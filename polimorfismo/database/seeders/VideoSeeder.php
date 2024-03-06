<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));

        $videos = Video::factory(10)->create();

        foreach ($videos as $video) {
            $video->image()->create([
                'url_imagen' => 'imagenes/' . fake()->picsum('public/storage/imagenes', 400, 400, false),
                'desc_imagen' => fake()->sentence(),
            ]);
        }
    }
}
