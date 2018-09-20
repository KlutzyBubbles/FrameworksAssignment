<?php

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'middle_initial' => $faker->optional()->randomLetter,
        'last_name' => $faker->lastName,
        'street_no' => $faker->numberBetween(1, 300),
        'street_name' => $faker->streetName,
        'suburb' => $faker->city,
        'postcode' => $faker->regexify('[0-9]{4}'),
        'email' => $faker->email,
        'auth' => $faker->regexify('[a-zA-Z0-9!@#$%^&*()]{256}'),
        'phone' => $faker->optional()->regexify('[0-9]{8,10}'),
        'enabled' => $faker->boolean(75),
    ];
});
