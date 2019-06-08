<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\category2;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //View::share('name','mouri');
        View::composer('front-end.includes.header',function($view){
            $view->with('categories',category2::where('publication_status',1)->get());
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
