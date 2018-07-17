<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Currency::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'rate' => $faker->randomFloat(2, 0, 999999.99)
    ];
});