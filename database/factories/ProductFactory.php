<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->words(3, true)),
        'description' => $faker->sentences(4, true),
        'price' => $faker->numberBetween(10, 300),
        'user_id' => null,
        'category_id' => null,
        'photo' => $faker->image(storage_path('app/public/products'), 300, 400, 'food', false),
        'photo_desc' => ucfirst($faker->words(3, true)),
    ];
});
