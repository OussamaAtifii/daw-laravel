<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'infantil' => '#FFB6C1',
            'accion'   => '#FFA07A',
            'digital'  => '#ADD8E6',
            'mecanico' => '#98FB98',
            'hardware' => '#FFDAB9',
            'software' => '#FFC0CB'
        ];

        foreach ($tags as $nombre => $color) {
            Tag::create(compact('nombre', 'color'));
        }
    }
}
