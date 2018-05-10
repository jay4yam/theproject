<?php

use Faker\Generator as Faker;
use App\Models\Categories;

$factory->define(Categories::class, function (Faker $faker) {
    return [
        'title' => $faker->randomElement($array = array('Hélicoptère', 'Voyage', 'Experience', 'Vol'))
    ];
});
