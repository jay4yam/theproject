<?php

use Faker\Generator as Faker;
use App\Models\Comments;

$factory->define(Comments::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'content' => $faker->paragraph(10),
    ];
});
