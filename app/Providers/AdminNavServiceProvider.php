<?php

namespace App\Providers;

use Route;
use App\Models\AdminModules;
use Illuminate\Support\ServiceProvider;

class AdminNavServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->ComposeAdminModules();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function ComposeAdminModules()
    {
        view()->composer('rcpadmin.layouts.nav', function ($view) {
            $action = app('request')->route()->getAction();
            $controller = class_basename($action['controller']);
            list($current_controller, $action) = explode('@', $controller);


            $view->with('modules', AdminModules::all()->toArray())->with('current_controller', $current_controller);
        });
        view()->composer('rcpadmin.layouts.sidebar', function ($view) {
            $action = app('request')->route()->getAction();
            $controller = class_basename($action['controller']);
            list($current_controller, $action) = explode('@', $controller);


            $view->with('modules', AdminModules::all()->toArray())->with('current_controller', $current_controller);
        });
    }
}
