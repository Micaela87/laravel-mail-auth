<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Posts;
use Faker\Generator as Faker;

$factory->define(Posts::class, function (Faker $faker) {
    return [
        'title' => $faker -> sentence(),
        'author' => $faker -> name(),
        'content' => $faker -> paragraphs(3, true),
        'release_date' => $faker -> date(),
        'rating' => $faker -> numberBetween(0, 5)
    ];
});
