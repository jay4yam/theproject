<?php

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Categories;

class BlogsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0 ; $i < Blog::all()->count(); $i++)
        {
            DB::table('blogs_categories')->insert(
                [
                    'blog_id' => array_random(array('1', '2', '3', '4', '5', '6')),
                    'categorie_id' => array_random(array('1', '2', '3', '4')),
                ]
            );
        }
    }
}
