<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->words(3, true)),
        'description' => $faker->sentences(4, true),
        'parent_id' => null,
    ];
});
