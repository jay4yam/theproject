<?php

use Faker\Generator as Faker;
use App\Models\Region;

$array = ['France', 'Italie', 'Mexique', 'USA'];

for ($i = 0; $i < count($array); $i++) {
    $factory->define(Region::class, function (Faker $faker) {
        return [
            'name' => $faker->country,
            'title' => $faker->sentence(5),
            'subtitle' => $faker->sentence(5),
            'description' => $faker->text(100),
            'main_photo' => $faker->image(),
        ];
    });
}
