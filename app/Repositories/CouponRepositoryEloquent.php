<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CouponRepository;
use App\Models\Coupon;
use Illuminate\Support\Facades\Request;

/**
 * Class CouponRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CouponRepositoryEloquent extends BaseRepository implements CouponRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Coupon::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function StoreByRequest($request): Coupon
    {
        $coupon = self::create([
            'coupon_code' => $request->coupon_code,
            'coupon_type' => $request->coupon_type,
            'min_amount' => $request->min_amount,
            'discount' => $request->discount,
            'limit' => $request->limit,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => true,
        ]);

        return $coupon;
    }


    public function UpdateByRequest($request, $coupon): Coupon
    {
        $coupon->update([
            'coupon_type' => $request->update_coupon_type,
            'min_amount' => $request->update_min_amount,
            'discount' => $request->update_discount,
            'limit' => $request->update_limit,
            'start_date' => $request->update_start_date,
            'end_date' => $request->update_end_date,
            'status' => $request->update_status,
        ]);

        return $coupon;
    }
    
}
