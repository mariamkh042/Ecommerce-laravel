<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Info;
use App\Models\Logo;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        $this->logo = Logo::first();
        view()->composer('layouts.admin.header.sidebar', function($view) {
            $view->with(['logo' => $this->logo]);
        });
        view()->composer('layouts.admin.header.placeholder', function($view) {
            $view->with(['logo' => $this->logo]);
        });
        view()->composer('layouts.admin.head.links', function($view) {
            $view->with(['logo' => $this->logo]);
        });

        view()->composer('layouts.frontend.head.links', function($view) {
            $view->with(['logo' => $this->logo]);
        });
        view()->composer('layouts.frontend.header.nav', function($view) {
            $view->with(['logo' => $this->logo]);
        });
        view()->composer('layouts.frontend.front', function($view) {
            $view->with(['logo' => $this->logo]);
        });
        view()->composer('layouts.app', function($view) {
            $view->with(['logo' => $this->logo]);
        });

        $this->data = Info::first();
        view()->composer('layouts.admin.header.sidebar', function($view) {
            $view->with(['datas' => $this->data]);
        });

        view()->composer('layouts.frontend.front', function($view) {
            $view->with(['datas' => $this->data]);
        });

        view()->composer('layouts.frontend.footer.footer', function($view) {
            $view->with(['datas' => $this->data]);
        });

        view()->composer('layouts.app', function($view) {
            $view->with(['datas' => $this->data]);
        });
  
        $this->cat = Categories::all();
        view()->composer('layouts.frontend.front', function($view) {
            $view->with(['cat' => $this->cat]);
        });

        $this->cat = Categories::all();
        view()->composer('layouts.frontend.footer.footer', function($view) {
            $view->with(['cat' => $this->cat]);
        });

    }
}
