<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Enums\CouponTypeEnums;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Repositories\CouponRepositoryEloquent;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $couponRepository;

    public function __construct(CouponRepositoryEloquent $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }
    public function index()
    {
        $coupons = Coupon::latest('id')->get();
        $couponTypes = CouponTypeEnums::cases();
        return view('admin.coupon.index', compact('coupons', 'couponTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string|unique:coupons,coupon_code|min:5',
            'coupon_type' => 'required|string',
            'min_amount' => 'required|numeric',
            'discount' => 'required|numeric',
            'limit' => 'required|numeric',
            'start_date' => 'required|date|after_or_equal:now',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $coupon = $this->couponRepository->StoreByRequest($request);

        return back()->with('success', 'Coupon created successfully');
    }

    public function update(Request $request, Coupon $coupon)
    {        
        $request->validate([
            'update_coupon_id' => 'required|exists:coupons,id',
            'update_coupon_type' => 'required|string',
            'update_min_amount' => 'required|numeric',
            'update_discount' => 'required|numeric',
            'update_limit' => 'required|numeric',
            'update_start_date' => 'required|date|after_or_equal:exists:coupons,start_date,' . $coupon->id,
            'update_end_date' => 'required|date|after_or_equal:update_start_date',
            'update_status' => 'required|in:0,1',
        ]);
        
        $coupon = $this->couponRepository->UpdateByRequest($request, $coupon);

        return back()->with('success', 'Coupon updated successfully');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back()->with('success', 'Coupon deleted successfully');
    }
}
