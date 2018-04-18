<?php

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'image_url' => $faker->imageUrl,
    ];
});

$factory->state(Category::class, 'parent', function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'image_url' => $faker->imageUrl
    ];
});
