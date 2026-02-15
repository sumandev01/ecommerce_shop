<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $user = auth('web')->user();
        $wishlists = Wishlist::with('product')->where('user_id', $user->id)->get();
        $wishlistsCount = Wishlist::where('user_id', $user->id)->count();
        return view('web.wishlist', compact('wishlists', 'wishlistsCount'));
    }

    public function wishlistStore($product)
    {
        $productId = Product::where('id', $product)->first();
        $userId = auth('web')->user()->id;

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId->id
        ]);

        return back()->with('success', 'Product added to wishlist successfully');
    }

    public function destroy($product)
    {
        $productId = Product::where('id', $product)->first();
        $userId = auth('web')->user()->id;
        Wishlist::where('product_id', $productId->id)->where('user_id', $userId)->delete();
        return back()->with('success', 'Product removed from wishlist successfully');
    }
}
