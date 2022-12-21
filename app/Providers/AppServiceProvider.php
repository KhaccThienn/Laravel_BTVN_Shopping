<?php

namespace App\Providers;

use App\Helpers\Cart;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        view()->composer(['layout.app', 'customers.product.index'], function ($view) {
            $cats = Category::get();
            $carts = new Cart();
            $cartss = $carts->getCart();
            $view->with(compact('cats', 'cartss', 'carts'));
        });
    }
}
