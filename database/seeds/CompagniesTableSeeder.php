<?php

use Illuminate\Database\Seeder;
use App\Models\Compagnie;

class CompagniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Compagnie::class, 20)->create(20);
    }
}
