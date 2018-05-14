<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
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
     * Test l'affichage de la page contact
     */
    public function access()
    {
        $response = $this->get('/'.\App::getLocale().'/contact');

        $response->assertStatus(200);
    }

    /**
     * Test acces page contact en etant logge
     */
    public function testAccessLogged()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/'.\App::getLocale().'/contact');

        $response->assertStatus(200);
    }
}
