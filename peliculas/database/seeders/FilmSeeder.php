<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = Film::factory(50)->create();

        foreach ($films as $film) {
            $tags = $this->getRandomTagsId();
            $film->tags()->attach($tags);
        }
    }

    private function getRandomTagsId()
    {
        $tags = Tag::pluck('id')->toArray();
        $tagsIndex = array_rand($tags, random_int(2, count($tags)));
        $tagDevolver = [];

        foreach ($tagsIndex as $index) {
            $tagDevolver[] = $tags[$index];
        }

        return $tagDevolver;
    }
}
