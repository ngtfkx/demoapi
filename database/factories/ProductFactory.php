<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => 1, //ucfirst($faker->words(3, true)),
        'description' => 2, //$faker->sentences(4, true),
        'price' => 3, //$faker->numberBetween(10, 300),
        'user_id' => null,
        'category_id' => null,
    ];
});
