<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Voyage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoyageTest extends TestCase
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
     * Test acces sur la page voyage
     */
    public function testAccess()
    {
        $response = $this->get('/'.\App::getLocale().'/voyages');

        $response->assertStatus(200);
    }

    /**
     * Test accès voyage en étant logge
     */
    public function testAccessLogged()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/'.\App::getLocale().'/voyages');

        $response->assertStatus(200);
    }


    public function testVoyagesIndexWithProduct()
    {
        $products = factory(Voyage::class,10)->make();

        $response = $this->get('/'.\App::getLocale(), compact('products'));

        $response->assertStatus(200);
    }
}
