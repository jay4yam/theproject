<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class SuperUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1. crée le superuser et le sauv. dans la table user
        $superUser = User::create([
            'email'=> 'jay.ayamee@gmail.com',
            'password' => bcrypt('Abraham75'),
            'role' => 'admin'
        ]);

        //2. crée un nouveau profil
        $profile = new Profile([
            'firstName' => 'jayBen',
            'fullName' => 'Abraham',
            'birthDate' => \Carbon\Carbon::create(1975, 07, 10),
            'phoneNumber' => '06.72.71.30.68',
            'address' => '490 chemin des quatres chemins',
            'postalCode' => '06600',
            'city' => 'Antibes',
            'country' => 'France'
        ]);

        //3. sauv. le profile du superUser
        $superUser->profile()->save($profile);
    }
}
