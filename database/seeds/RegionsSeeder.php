<?php

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['France', 'Italie', 'Mexique', 'USA'];

        for ($i = 0; $i < count($array); $i++)
        {
            Region::create([
                'name' => $array[$i],
            ]);
        }
    }
}
