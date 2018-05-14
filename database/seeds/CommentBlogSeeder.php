<?php

use Illuminate\Database\Seeder;
use App\Models\Comments;

class CommentBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comments::class, 20)->create([
            'commentable_type' => 'blog',
            'commentable_id' => 21
        ]);
    }
}
