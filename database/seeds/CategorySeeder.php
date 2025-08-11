<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Велосипеды',
                'slug' => 'velosipedy',
            ],
            [
                'name' => 'Шлемы',
                'slug' => 'shlemy',
            ],
            [
                'name' => 'Фонари',
                'slug' => 'fonari',
            ],
        ];

        foreach ($items as $item) {
            Category::create($item);
        }
    }
}
