<?php

namespace App\Http\Controllers\Web;

use App\Enums\Enums\OrderStatusEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\BillingAddress;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Repositories\BillingAddressRepositoryEloquent;
use App\Repositories\OrderRepositoryEloquent;
use App\Repositories\ProductRepositoryEloquent;
use App\Repositories\ShippingAddressRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orderRepo;
    protected $productRepo;
    protected $billingAddressRepo;
    protected $shippingAddressRepo;

    public function __construct(OrderRepositoryEloquent $orderRepo, ProductRepositoryEloquent $productRepo, BillingAddressRepositoryEloquent $billingAddressRepo, ShippingAddressRepositoryEloquent $shippingAddressRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
        $this->billingAddressRepo = $billingAddressRepo;
        $this->shippingAddressRepo = $shippingAddressRepo;
    }

    public function store(OrderRequest $request)
    {
        try {
            $user = auth('web')->user();
            $order = $this->orderRepo->storeByRequest($request, $user);
            return redirect()->route('order.success')->with('order_success', $order);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function success()
    {
        if (!session()->has('order_success')) {
            return redirect()->route('root');
        }
        $order = session()->get('order_success');
        return view('web.order-success', compact('order'));
    }
}
