<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest('id')->get();
        $categories = Category::latest('id')->get();
        $recentlyAdd = $products->sortByDesc('created_at')->take(3);
        return view('web.index', compact('products', 'categories', 'recentlyAdd'));
    }

    public function shop()
    {
        $productsQuery = Product::where('status', 1);
        $products = $productsQuery->latest('id')->paginate(20)->withQueryString();
        $newProducts = $products->sortByDesc('created_at')->take(4);
        $categories = Category::withCount('products')->latest('id')->get();
        $colors = Color::withCount(['colors' => function ($query) {
            $query->distinct();
        }])->latest('id')->get();
        return view('web.shop', compact('products', 'newProducts', 'categories', 'colors'));
    }

    public function about()
    {
        return view('web.about');
    }

    public function faq()
    {
        return view('web.faq');
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function compare()
    {
        return view('web.compare');
    }

    public function singleProduct($slug)
    {
        $product = Product::where('slug', $slug)->where('status', 1)->firstOrFail();
        $productGalleries = $product->galleries;
        $colors = $product->colors;
        $sizes = $product->sizes;
        $tags = $product->tags;
        return view('web.singleProduct', compact('product', 'slug', 'productGalleries', 'colors', 'sizes', 'tags'));
    }

    public function getProdutVariantInventory(Request $request)
    {
        $productId = $request->productId;
        $colorId = $request->colorId;
        $sizeId = $request->sizeId;
        
        $stock = 0;
        if ($colorId && $sizeId) {
            $inventory = ProductInventory::where('product_id', $productId)->where('color_id', $colorId)->where('size_id', $sizeId)->first();

            $stock = $inventory ? $inventory->quantity : 0;
        }

        $availableSizeIds = [];
        if($colorId) {
            $availableSizeIds = ProductInventory::where('product_id', $productId)->where('color_id', $colorId)->pluck('size_id')->toArray();
        }
        
        $availableColorIds = [];
        if($sizeId) {
            $availableColorIds = ProductInventory::where('product_id', $productId)->where('size_id', $sizeId)->pluck('color_id')->toArray();
        }

        return response()->json([
            'stock' => $stock,
            'availableSizeIds' => $availableSizeIds,
            'availableColorIds' => $availableColorIds,
        ]);
    }

    public function recentViews()
    {
        return view('web.recently-view');
    }
}
