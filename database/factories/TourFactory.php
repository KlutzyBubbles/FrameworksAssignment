<?php

use Faker\Generator as Faker;

$factory->define(App\Tour::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'description' => $faker->realText(100),
        'duration' => $faker->optional(0.5)->randomFloat(2, 1, 50),
        'route_map' => $faker->optional(0.5)->url,
    ];
});
