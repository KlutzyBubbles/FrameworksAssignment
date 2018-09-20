<?php

use Faker\Generator as Faker;

$factory->define(App\Itinerary::class, function (Faker $faker) {
    return [
        'hotel_booking' => $faker->text(6),
        'activities' => $faker->optional(0.5)->realText(150),
        'meals' => $faker->optional(0.5)->realText(150),
    ];
});
