<?php

use Faker\Generator as Faker;
use App\Models\Voyage;

$factory->define(Voyage::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'parent_id' => 0,
        'locale' =>'fr',
        'subtitle' => $faker->sentence(4),
        'intro' => $faker->paragraph(),
        'description' => $faker->paragraph(10),
        'main_photo' => $faker->image(),
        'price' => $faker->randomFloat(),
        'is_discounted' => $faker->boolean(),
        'is_public' => $faker->boolean(),
        'discount_price' => $faker->randomFloat(2, 50, 400),
        'duree_du_vol' => $faker->numberBetween(1,30),
        'ville_id' => array_rand(array(1 => 1,2 => 2,3 => 3), 1)
    ];
});
