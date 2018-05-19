<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //SuperUserTableSeeder::class,
            //UsersTableSeeder::class,
            //CompagniesTableSeeder::class,
            //BlogsTableSeeder::class,
            //CategoriesTableSeeder::class,
            //BlogsCategoriesTableSeeder::class,
            //CommentBlogSeeder::class,
            //TagsTableSeeder::class,
            //RegionsSeeder::class,
            //VillesSeeder::class,
            VoyagesSeeder::class,
        ]);
    }
}
