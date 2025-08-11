<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

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
        View::composer('blocks.nav', function ($view) {
            $categories = Cache::remember('categories_menu', 1, function () {
                return Category::getNameAndUrl();
            });

            // dd($categories);

            $view->with('categories', $categories);
        });
    }
}
