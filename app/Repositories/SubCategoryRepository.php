<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SubCategoryRepository.
 *
 * @package namespace App\Repositories;
 */
interface SubCategoryRepository extends RepositoryInterface
{
    public function storeByRequest($request);
}
