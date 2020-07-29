<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishlistItem;
use App\Mails\SendItemConfirm;
use Illuminate\Support\Facades\Mail;

class BuyingController extends Controller
{
    public function index()
    {
        $items = WishlistItem::where('buyer_id', authUserId())->paginate(5);

        return view('buying.index', compact('items'));
    }

    public function update(WishlistItem $item)
    {
        try {
            if ($item->buyer) {
                return redirect()
                    ->back()
                    ->with(['errorMessage' => "Wish is already taken by someone!"]);
            }

            $item->update([
                'buyer_id' => authUserId()
            ]);

            $item->load('buyer');

            Mail::to(auth()->user()->email)
                ->send(new SendItemConfirm($item));

            return redirect()
                ->back()
                ->with(['successMessage' => "Wish is now assigned to you!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->withInput()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }

    public function remove(WishlistItem $item)
    {
        try {
            if ($item->purchased) {
                return redirect()
                    ->back()
                    ->with(['errorMessage' => "Wish is already purchased!"]);
            }

            $item = $item->update([
                'buyer_id' => null
            ]);

            return redirect()
                ->back()
                ->with(['successMessage' => "Wish is not assigned to you!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->withInput()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }

    public function purchased(WishlistItem $item)
    {
        try {
            if ($item->buyer_id != authUserId()) {
                return redirect()
                    ->back()
                    ->with(['errorMessage' => "Error on your request!"]);
            }

            $item->update(['purchased' => true]);

            return redirect()
                ->back()
                ->with(['successMessage' => "Wish status updated to purchased!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->withInput()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }

    public function unpurchased(WishlistItem $item)
    {
        try {
            if ($item->buyer_id != authUserId()) {
                return redirect()
                    ->back()
                    ->with(['errorMessage' => "Error on your request!"]);
            }

            $item->update(['purchased' => false]);

            return redirect()
                ->back()
                ->with(['successMessage' => "Wish status updated to unpurchased!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->withInput()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }
}
