<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::latest('id')->get();
        return view('web.index', compact('categories'));
    }

    public function shop()
    {
        return view('web.shop');
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

    public function singleProduct()
    {
        return view('web.singleProduct');
    }

    public function recentViews()
    {
        return view('web.recently-view');
    }
}
