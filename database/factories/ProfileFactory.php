<?php

use Faker\Generator as Faker;
use App\Models\Profile;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName(),
        'fullName' => $faker->name(),
        'birthDate' => $faker->date(),
        'phoneNumber' => $faker->phoneNumber,
        'address' => $faker->address,
        'postalCode' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country
    ];
});
