<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invite;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function index()
    {  
        return view('index');
    }

    public function shared(Request $request, $code)
    {
        try {
            $invite_id = $request->get('invite_id');
            $invite = Invite::find($invite_id);
            session(['email' => $invite->email ?? null]);
            $hasUser = false;

            if ($invite->user ?? false) {
                $hasUser = true;
            }

            $wishlist = Wishlist::with('participants')
                ->where('public_url', 'LIKE', "%{$code}")
                ->first();

            if ($wishlist) {
                $items = $wishlist->wishes()->paginate(5);

                return view('wishlist.show', compact('hasUser', 'invite_id', 'wishlist', 'items'));
            }

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->route('home')
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }
    
    public function register(Request $request)
    {
        try {
            $invite = Invite::find($request->get('invite_id'));
            $email = $invite->email ?? session('email');
            $name = null;

            if ($email) {
                $name = explode('@', $email)[0];
            }

            if ($invite) {
                session(['go_link' => route('wishlists.show', $invite->wishlist)]);
            }

            return view('register', compact('email', 'name'));

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->route('register')
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }
    
    public function storeRegister(RegisterRequest $request)
    {
        try {
            $user = new User;
            $user = $user->create($request->only($user->getFillable()));
            $invites = Invite::with('wishlist')->whereEmail($user->email)->get();

            foreach ($invites as $invite) {
                $invite->wishlist->participants()->attach($user->id);
            }

            auth()->login($user);

            if (session('go_link')) {
                return redirect(session('go_link'))
                ->with(['successMessage' => "You have successfully registered!"]);
            }

            return redirect()
                ->route('wishlists.participated')
                ->with(['successMessage' => "You have successfully registered!"]);
            
        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }

        return redirect()
            ->route('register')
            ->withInput()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }
}
