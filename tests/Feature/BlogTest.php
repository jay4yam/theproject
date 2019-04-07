<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Test acces sur la home page
     */
    public function testBlogAccess()
    {
        $response = $this->get('/'.\App::getLocale().'/blog');

        $response->assertStatus(200);
    }

    /**
     * Test accès blog en étant logge
     */
    public function testAccessLogged()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/'.\App::getLocale().'/blog');

        $response->assertStatus(200);
    }
}
