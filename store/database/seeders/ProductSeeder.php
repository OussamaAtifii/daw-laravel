<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory(50)->create();

        foreach ($products as $product) {
            $product->tags()->attach(self::getTagsId());
        }
    }


    private static function getTagsId()
    {
        $tags = [];
        $tagsId = Tag::pluck('id')->toArray();
        $randIndex = array_rand($tagsId, random_int(2, count($tagsId)));

        foreach ($randIndex as $index) {
            $tags[] = $tagsId[$index];
        }

        return $tags;
    }
}
