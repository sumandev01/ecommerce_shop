<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ShippingAddressRepository;
use App\Models\ShippingAddress;
use App\Validators\ShippingAddressValidator;

/**
 * Class ShippingAddressRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ShippingAddressRepositoryEloquent extends BaseRepository implements ShippingAddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ShippingAddress::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public static function storeByRequest($request, $order, $user){
        if ($request->differentAddress == 1) {
            ShippingAddress::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'name' => $request->shippingName,
                'email' => $request->shippingEmail,
                'phone' => $request->shippingPhone,
                'address' => $request->shippingAddress,
                'country' => $request->shippingCountry,
                'city' => $request->shippingCity,
                'postcode' => $request->shippingPost,
                'company_name' => $request->shippingCompany,
            ]);
        } else {
            ShippingAddress::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'country' => $request->country,
                'city' => $request->city,
                'postcode' => $request->postcode,
                'company_name' => $request->company,
            ]);
        }
    }
    
}
