<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /** @test */
    public function user_cant_browse_home()
    {
    	$user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/');

        $response->assertRedirect('/wishlists');
    }

    /** @test */
    public function user_can_browse_participated_wishlists()
    {
    	$user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/wishlists');

        $response->assertSee('Participated Wishlists');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_browse_owned_wishlists()
    {
    	$user = factory(User::class)->create();
    	$wishlists = factory(Wishlist::class, rand(0, 10))->create(['organizer_id' => $user->id]);
        $response = $this->actingAs($user)->get('/my-wishlists');

        $response->assertSee('My Wishlists');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_browse_wishlist()
    {
    	$user = factory(User::class)->create();
    	$wishlist = factory(Wishlist::class)->create();
    	$wishlist->participants()->attach($user->id);
        $response = $this->actingAs($user)->get('/wishlists/' . $wishlist->id);

        $response->assertSee($wishlist->title);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_cant_browse_wishlist()
    {
        $user = factory(User::class)->create();
        $wishlist = factory(Wishlist::class)->create();
        $response = $this->actingAs($user)->get('/wishlists/' . $wishlist->id);

        $response->assertSee(404);
        $response->assertStatus(404);
    }

    /** @test */
    public function user_can_browse_to_buy_list()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/to-buy/list');

        $response->assertSee('To Buy');
        $response->assertStatus(200);
    }
}
