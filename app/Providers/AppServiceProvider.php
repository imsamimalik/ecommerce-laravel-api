<?php

namespace App\Providers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WishlistResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        UserResource::withoutWrapping();
        OrderResource::withoutWrapping();
        WishlistResource::withoutWrapping();
        ProductResource::withoutWrapping();

    }
}
