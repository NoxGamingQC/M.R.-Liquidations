<?php

namespace App\Providers;

use App\PageList;
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
        if($this->app->environment('production') || env('APP_URL') !== 'http://localhost') {
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
