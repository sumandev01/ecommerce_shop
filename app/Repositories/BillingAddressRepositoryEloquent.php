<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BillingAddressRepository;
use App\Models\BillingAddress;
use App\Validators\BillingAddressValidator;

/**
 * Class BillingAddressRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BillingAddressRepositoryEloquent extends BaseRepository implements BillingAddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BillingAddress::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public static function storeByRequest($request, $order, $user)
    {
        BillingAddress::create([
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
