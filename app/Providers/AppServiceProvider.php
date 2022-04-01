<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Contact;
use App\Bill;

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
        //Menu Product
        view()->composer('layouts.home', function ($view){
            $categories = Category::all()->where('parent_id', 0)->sortBy('sort_order');
            $view->with(['categories' => $categories]);
        });

        view()->composer('layouts.admin', function ($view){
            $bill = Bill::where('status', '==', 0)->count();
            $view->with(['bill' => $bill]);
        });
    }
}
