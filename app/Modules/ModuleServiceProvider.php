<?php

namespace App\Modules;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
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
        // For each of the registered modules, include their routes and Views
        $active_version = config("module.active_version"); 
        $modules = config("module.modules.".$active_version);
        $module_path = config("module.modules_path");
        
        //  dd($module_path);
        foreach($modules  as $module) {

            /**
             * 
             * 
             * 
             * Load the routes for each of the modules
             * 
             * 
             * 
             */
            if(file_exists($module_path.$active_version.'/'.$module.'/web.php')) {
                include $module_path.$active_version.'/'.$module.'/web.php';
             }


            if(file_exists($module_path.$active_version.'/'.$module.'/api.php')) {
                include $module_path.$active_version.'/'.$module.'/api.php';
             }

            /**
             * 
             * 
             * 
             *  Load the views
             * 
             *  
             * 
             */
            
            
            //   dd(__DIR__.'/'.$active_version.'/'.$module.'/Views');

             
            if(is_dir(__DIR__.'/'.$active_version.'/'.$module.'/Views')) {
                View::addNamespace($module, __DIR__.'/'.$active_version.'/'.$module.'/Views' );
               ($this->loadViewsFrom(__DIR__.'/'.$active_version.'/'.$module.'/Views', $module));
             }

            /**
             * 
             * 
             * Here We Publish Migrations
             * 
             * 
             */
            if(is_dir($module_path.$active_version.'/'.$module.'/Migrations')) {
                $this->publishes([
                    $module_path.$active_version.'/'.$module.'/Migrations',
                ], 'migrations');
                $this->loadMigrationsFrom($module_path.$active_version.'/'.$module.'/Migrations');
             }
        }
    }
}
