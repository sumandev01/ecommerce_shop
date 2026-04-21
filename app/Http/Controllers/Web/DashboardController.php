<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth('web')->user();
        $orders = Order::where('user_id', $user->id)->withCount('order_products')->latest()->limit(4)->get();
        return view('web.dashboard.index', compact('orders'));
    }

    public function orders()
    {
        $user = auth('web')->user();
        $orders = Order::where('user_id', $user->id)->withCount('order_products')->latest()->get();
        return view('web.dashboard.orders', compact('orders'));
    }

    public function orderDetails(Order $order)
    {
        return view('web.dashboard.order-details', compact('order'));
    }
}
