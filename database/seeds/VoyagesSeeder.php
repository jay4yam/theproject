<?php

use Illuminate\Database\Seeder;
use App\Models\Voyage;

class VoyagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Voyage::class, 10)->create();
    }
}
