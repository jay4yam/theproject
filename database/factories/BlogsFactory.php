<?php

use Faker\Generator as Faker;
use App\Models\Blog;
use App\Models\User;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'locale' => 'fr',
        'title' => $faker->sentence(10),
        'intro' => $faker->paragraph(2),
        'slug' => 'url-slugee-pour-url-rewritting',
        'content' => $faker->paragraph(5),
        'main_image' => 'images/backgrounds/background-22-1920x900.jpg',
        'is_public' => $faker->boolean($chanceOfGettingTrue=50),
        'user_id' => '1',
    ];
});
