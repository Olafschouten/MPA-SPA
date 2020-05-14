<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products;
use Faker\Generator as Faker;

$factory->define(Products::class, function (Faker $faker) {
    return [
        'title' => $faker->firstName,
        'description' => $faker->text($maxNbChars = 200),
        'price' => $faker->numerify('##'),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
