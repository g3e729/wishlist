<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\WishlistItem;
use App\Services\FileService;
use Illuminate\Http\Request;
use App\Http\Requests\WishlistItemRequest;

class WishlistItemController extends Controller
{
    public function store(WishlistItemRequest $request, Wishlist $wishlist)
    {
        try {
            $data = $request->only((new WishlistItem)->getFillable());
            $data['img_url'] = fileUpload() ?? $data['img_url'];
            $wishlist->wishes()->create($data);

            return redirect()->route('wishlists.show', compact('wishlist'))
                ->with(['successMessage' => "Item successfully added!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }
    
    public function update(WishlistItemRequest $request, WishlistItem $item)
    {
        try {
            $data = $request->only((new WishlistItem)->getFillable());
            $data['img_url'] = fileUpload() ?? $data['img_url'];


            $item->update($data);

            return redirect()
                ->back()
                ->with(['successMessage' => "Item successfully updated!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }

    public function destroy(WishlistItem $item)
    {
        try {
            $item->delete();

            return redirect()
                ->back()
                ->with(['successMessage' => "Item successfully deleted!"]);

        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . ' ' . $ex->getMessage());
        }
        
        return redirect()
            ->back()
            ->with(['errorMessage' => "There's an error on your request. Please try again."]);
    }
}
