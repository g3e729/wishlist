<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GuestTest extends TestCase
{
    /** @test */
    public function can_browse_home()
    {
        $response = $this->get('/');

        $response->assertSee('Wonderful Time Of The Year');
        $response->assertStatus(200);
    }

    /** @test */
    public function can_browse_register()
    {
        $response = $this->get('/register');

        $response->assertSee('Register');
        $response->assertStatus(200);
    }

    /** @test */
    public function can_browse_public_wishlist()
    {
        $wishlist = create(Wishlist::class);
        $response = $this->get($wishlist->public_url);

        $response->assertSee($wishlist->title);
        $response->assertStatus(200);
    }
}
