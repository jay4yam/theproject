<?php

use Illuminate\Database\Seeder;
use App\Models\Ville;

class VillesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['Nice', 'Monaco', 'Paris', 'Bordeaux'];

        for($i = 0; $i < count($array); $i++)
        {
            Ville::create([
                'name' => $array[$i],
                'region_id' => 1
            ]);
        }

    }
}
