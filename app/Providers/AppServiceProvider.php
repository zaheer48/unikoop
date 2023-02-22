<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Schema;use Illuminate\Pagination\Paginator;
use Nwidart\Modules\Facades\Module;

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

        $settings = [];

        if(Schema::hasTable('website_settings'))
            $settings = \DB::table('website_settings')->first();
        View::share('settings', $settings);
        
        $modules = Module::all();
        View::share('modules', $modules);
    }
}
