<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use \App\Models\Blog;

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
            DB::table('taggables')->insert(
                [
                    'tag_id' => $i,
                    'taggable_id' => 1,
                    'taggable_type' => Blog::class,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
        }
    }
}
