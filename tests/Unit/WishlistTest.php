<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\WishlistItem;

class WishlistTest extends TestCase
{
    /** @test */
    public function create()
    {
    	$wishlist = create(Wishlist::class, ['title' => 'Test Wishlist']);

        $this->assertTrue(Wishlist::find($wishlist->id)->title == 'Test Wishlist');
    }

    /** @test */
    public function update()
    {
    	$wishlist = create(Wishlist::class);
    	$title = 'Update Title';
    	$wishlist->update(compact('title'));

        $this->assertTrue((Wishlist::find($wishlist->id)->title ?? null) == $title);
    }

    /** @test */
    public function add_items()
    {
    	$wishlist = create(Wishlist::class);
    	$wishlistItems = create(WishlistItem::class, ['wishlist_id' => $wishlist->id], 10);

        $this->assertTrue($wishlist->wishes()->count() == $wishlistItems->count());
    }

    /** @test */
    public function remove_item()
    {
    	$wishlist = create(Wishlist::class);
    	$wishlistItems = create(WishlistItem::class, ['wishlist_id' => $wishlist->id], 10);
    	$item = $wishlistItems->random();
    	$item->delete();

        $this->assertTrue(is_null($wishlist->wishes()->find($item->id)));
    }

    /** @test */
    public function invite_participants()
    {
    	$users = create(User::class, [], rand(3, 10));
    	$wishlist = create(Wishlist::class);
    	$participants = 0;

    	foreach($users as $user) {
    		if (rand(0, 1)) {
    			$wishlist->participants()->attach($user->id);
    			$participants++;
    		}
    	}

        $this->assertTrue($wishlist->participants()->count() == $participants);
    }

    /** @test */
    public function remove_participants()
    {
    	$users = create(User::class, [], rand(3, 10));
    	$wishlist = create(Wishlist::class);
    	$usersCount = $users->count();
    	$take = rand(1, $usersCount);
    	$participants = $usersCount - $take;

    	$wishlist->participants()->attach($users->pluck('id'));
    	$wishlist->participants()->detach($users->shuffle()->take($take)->pluck('id'));

        $this->assertTrue($wishlist->participants()->count() == $participants);
    }

    /** @test */
    public function destroy()
    {
    	$wishlist = create(Wishlist::class);
    	$wishlist->delete();

        $this->assertTrue(is_null(Wishlist::find($wishlist->id)));
    }
}
