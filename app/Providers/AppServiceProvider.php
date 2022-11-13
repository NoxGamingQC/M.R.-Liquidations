<?php

namespace App\Providers;

use Auth;
use App\PageList;
use App\ShoppingCart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pageList = PageList::all();
        $pages = [];
        if($this->app->environment('production') || env('APP_URL') !== 'http://localhost:8000') {
            \URL::forceScheme('https');
            foreach($pageList as $key => $page) {
                $pages[$page->slug] = [
                    'slug' => $page->slug,
                    'inMaintenance' => $page->inMaintenance
                ];
            }
        } else {
            foreach($pageList as $key => $page) {
                $pages[$page->slug] = [
                    'slug' => $page->slug,
                    'inMaintenance' => false
                ];
            }
        }

        if(env('GIT_SHA')) {
            $sourceVersion = env('GIT_SHA');
        } else {
            $sourceVersion = 'undefined';
        }
        view()->composer('*', function ($view)  {
            if(Auth::check()) {
                $itemCartCount = count(ShoppingCart::where('user_id', Auth::user()->id)->getItems()->get());
            } else {
                $itemCartCount = 0;
            }
            view()->share('itemCartCount', $itemCartCount);
        });
        view()->share('sourceVersion', $sourceVersion);
        return view()->share('page', $pages);
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
