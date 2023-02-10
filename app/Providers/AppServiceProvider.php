<?php

namespace App\Providers;

use App\Repository\product\IProductRepository;
use App\Repository\product\ProductRepository;
use App\Repository\Review\IReviewRepository;
use App\Repository\Review\ReviewRepository;
use App\Services\Product\IProductService;
use App\Services\Product\ProductService;
use App\Services\Review\IReviewService;
use App\Services\Review\ReviewService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function provides()
    {
        return [
            IProductService::class,
            IProductRepository::class,
            IReviewService::class,
            IReviewRepository::class,
        ];
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(IProductService::class, ProductService::class);
        $this->app->singleton(IProductRepository::class, ProductRepository::class);

        $this->app->singleton(IReviewService::class, ReviewService::class);
        $this->app->singleton(IReviewRepository::class, ReviewRepository::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
