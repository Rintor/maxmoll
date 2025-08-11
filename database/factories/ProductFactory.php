<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->name;

    return [
        'name' => $name,
        'category_id' => rand(1, 3),
        'slug' => Str::slug($name),
        'price' => $faker->randomFloat(2, 100, 5000),
        'image_url' => rand(0, 1) ? '/images/uploads/bike.jpg' : null,
        'description' => $faker->paragraph(rand(1, 3)),
    ];
});
