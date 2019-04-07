<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Voyage;
use App\Repositories\VoyageRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
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
    public function testAccess()
    {
        $response = $this->get('/'.\App::getLocale());

        $response->assertStatus(200);
    }

    /**
     * Test l'accès à la home page en étant logge
     */
    public function testAccessLogged()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/'.\App::getLocale());

        $response->assertStatus(200);
    }

    /**
     * Test l'affichage de la home avec les produits
     */
    public function testHomeProducts()
    {

        $products = factory(Voyage::class,10)->make();

        $response = $this->get('/'.\App::getLocale(), compact('products'));

        $response->assertStatus(200);
    }
}
