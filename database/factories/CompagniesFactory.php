<?php

use Faker\Generator as Faker;
use App\Models\Compagnie;

$factory->define(Compagnie::class, function (Faker $faker) {
    return [
        'raison_sociale' => $faker->company,
        'adresse' => $faker->address,
        'code_postal' => $faker->postcode,
        'ville' => $faker->country,
        'telephone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'mail_resa' => $faker->email,
        'num_licence' => 'lc.492.m',
        'baseline' => $faker->sentence(7),
        'intro' => $faker->text(1000),
        'presentation' => $faker->text(2000),
        'logo' => 'defaut-logo.jpg',
        'background_image' => 'defaut-background.jpg',
    ];
});
