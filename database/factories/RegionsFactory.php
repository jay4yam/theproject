<?php

use Faker\Generator as Faker;
use App\Models\Region;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'main_photo' => $faker->image(),
    ];
});
