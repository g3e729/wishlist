<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invite;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use App\Http\Requests\WishlistRequest;
use App\Http\Requests\WishlistInviteRequest;

class WishlistController extends Controller
{
    public function index()
    {
        $type = 'participated';
    	$wishlists = Wishlist::whereHas('participants', function ($query) {
    		$query->whereUserId(authUserId());
    	})->get();

    	return view('wishlist.index', compact('type', 'wishlists'));
    }

    public function show(Request $request, Wishlist $wishlist)
    {
        if ($wishlist->organizer_id != authUserId() && $wishlist->participants()->whereUserId(authUserId())->count() < 1) {
            abort(404);
        }
        
    	$wishlist->load('wishes', 'participants');
        $owned = $wishlist->organizer_id == authUserId();
        $new = $request->has('new') ? 1 : 0;

        $items = $wishlist->wishes()->paginate(5);

    	return view('wishlist.show', compact('new', 'owned', 'wishlist', 'items'));
    }

    public function store(WishlistRequest $request)
    {
        try {
            $wishlist = new Wishlist;
            $wishlist = $wishlist->create($request->only($wishlist->getFillable()));
            $new = 1;

            return redirect()
                ->route('wishlists.show', compact('new', 'wishlist'))
                ->with(['successMessage' => "Wishlist successfully created!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->withInput()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }

    public function update(WishlistRequest $request, Wishlist $wishlist)
    {
        try {
            $wishlist->update($request->only($wishlist->getFillable()));

            return redirect()
                ->route('wishlists.show', compact('wishlist'))
                ->with(['successMessage' => "Wishlist successfully updated!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->withInput()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }

    public function destroy(Wishlist $wishlist)
    {
        try {
            $wishlist->delete();

            return redirect()
                ->route('wishlists.mine')
                ->with(['successMessage' => "Wishlist successfully removed!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->withInput()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }

    public function myList()
    {
        $type = 'mine';
        $wishlists = Wishlist::where('organizer_id', authUserId())->get();

        return view('wishlist.index', compact('type', 'wishlists'));
    }

    public function invite(WishlistInviteRequest $request, Wishlist $wishlist)
    {
        try {
            $emails = $request->get('emails');
            $processed = 0;

            foreach($emails as $email) {
                $user = User::whereEmail($email)->first();
                $user_id = null;

                if ($user) {
                    $user_id = $user->id;

                    if ($wishlist->participants()->whereUserId($user_id)->count() ||
                        $wishlist->organizer_id == authUserId()
                    ) {
                        continue;
                    }

                    $wishlist->participants()->attach($user->id);
                }

                $wishlist_id = $wishlist->id;
                
                Invite::firstOrCreate(compact('email', 'wishlist_id', 'user_id'));
                $processed++;
            }

            if ($processed > 0) {
                return redirect()
                    ->back()
                    ->with(['successMessage' => "Invitation will be sent soon!"]);
            }

            return redirect()
                ->back()
                ->with(['errorMessage' => "All emails are already part of your wishlist!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->withInput()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }

    public function uninvite(WishlistInviteRequest $request, Wishlist $wishlist, User $participant)
    {
        try {
            $wishlist->participants()->detach($participant->id);

            return redirect()
                ->back()
                ->with(['successMessage' => "Participant successfully removed!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->withInput()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }
}
