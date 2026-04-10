<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderRepositoryRepository;
use App\Entities\OrderRepository;
use App\Validators\OrderRepositoryValidator;

/**
 * Class OrderRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderRepositoryRepositoryEloquent extends BaseRepository implements OrderRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderRepository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
