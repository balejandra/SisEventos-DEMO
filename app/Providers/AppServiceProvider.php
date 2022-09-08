<?php

namespace App\Providers;

use App\Models\Publico\Menu;
use Illuminate\Support\Facades\View;
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
        
        View::composer("partials.menu.menu", function ($view) {
            $menus = Menu::getMenu(true);
            $view->with('menus', $menus);
        });
       // View::share('partials', 'menu');
    }
}
