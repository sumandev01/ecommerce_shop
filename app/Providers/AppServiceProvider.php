<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\BrandRepository;
use App\Repositories\BrandRepositoryEloquent;
use App\Repositories\SubCategoryRepository;
use App\Repositories\SubCategoryRepositoryEloquent;
use App\Repositories\MediaRepository;
use App\Repositories\MediaRepositoryEloquent;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(MediaRepository::class, MediaRepositoryEloquent::class);
        $this->app->bind(SubCategoryRepository::class, SubCategoryRepositoryEloquent::class);
        $this->app->bind(BrandRepository::class, BrandRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        paginator::useBootstrap();
    }
}
