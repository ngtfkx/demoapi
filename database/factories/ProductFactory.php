<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->words(3, true)),
        'description' => $faker->sentences(4, true),
        'price' => $faker->numberBetween(10, 300),
        'calorific' => $faker->optional(0.8)->numberBetween(500, 1000),
        'is_new' => $faker->boolean(10),
        'is_top' => $faker->boolean(10),
        'user_id' => null,
        'category_id' => null,
        'photo' => $faker->image(storage_path('app/public/products'), 200, 200, 'food', false),
        'photo_desc' => ucfirst($faker->words(3, true)),
    ];
});
