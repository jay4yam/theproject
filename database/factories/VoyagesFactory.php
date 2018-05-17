<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title' => $faker->words(2),
        'subtitle' => $faker->sentence(4),
        'description' => $faker->realText(),
        'main_photo' => $faker->image(),
        'price' => $faker->numberBetween([60, 250]),
        'duree_du_vol' => $faker->time('m'),
        'ville_id' => $faker->randomElement([1,2,3]),
    ];
});
