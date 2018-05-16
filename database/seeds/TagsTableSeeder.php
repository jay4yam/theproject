<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class, 20)->create();

        for($i = 1; $i < 21; $i++)
        {
            DB::table('taggable')->insert(
                [
                    'tag_id' => $i,
                    'taggable_id' => $i,
                    'taggable_type' => 'App/Models/Tag',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
        }
    }
}
