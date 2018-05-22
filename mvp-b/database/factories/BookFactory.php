<?php

use App\Book;
use App\Publisher;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title:en' => 'en:'.$faker->sentence,
        'title:nl' => 'nl:'.$faker->sentence,
        'description:en' => 'en:'.$faker->sentences(15, true),
        'description:nl' => 'nl:'.$faker->sentences(15, true),
        'isbn' => $faker->isbn13,
        'eISBN' => $faker->isbn13,
        'publisher_id' => function() {
            return factory(Publisher::class)->create()->id;
        }
    ];
});
