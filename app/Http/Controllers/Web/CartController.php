<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        return view('web.cart');
    }

    public function addToCart(Request $request)
    {
        dd($request->all());
        Request()->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
        ]);
    }
}
