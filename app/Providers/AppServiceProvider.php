<?php

namespace App\Providers;

use App\GoodCat;
use Illuminate\Support\ServiceProvider;
use Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend('non_numeric', function($attribute, $value, $parameters, $validator) {
            if(is_numeric($value)){
                return false;
            }
            return true;
        });
        view()->composer('*', function ($view) {
            $cats = GoodCat::with('tags')->orderby('cat_index', 'asc')->get();
            $view->with('cats', $cats);
        });
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
