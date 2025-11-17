<?php

namespace App\Providers;

use App\Observers\BaseModelObserver;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //Defining Gates
        Gate::define('Admin',function ($user){
            return $user->hasRole('Admin');
        });

        Gate::define('StoreOfficer',function ($user){
            return $user->hasRole('Store Officer');
        });

        Gate::define('Bar',function ($user){
            return $user->hasRole('Bar');
        });

        Gate::define('Approver',function ($user){
            return $user->hasRole('Approver');
        });

        Gate::define('FrontOfficer',function ($user){
            return $user->hasRole('Front Officer');
        });

        Gate::define('Kitchen',function ($user){
            return $user->hasRole('Kitchen');
        });

        Gate::define('House Keeping',function ($user){
            return $user->hasRole('House Keeping');
        });


        $modulesPath = base_path('Modules');
        $moduleDirs = File::directories($modulesPath);

        foreach ($moduleDirs as $modulePath) {
            $moduleName = basename($modulePath);
            $modelPath = $modulePath . '/app/Models';

            if (!File::exists($modelPath)) {
                continue;
            }

            $modelFiles = File::allFiles($modelPath);

            foreach ($modelFiles as $file) {
                $className = pathinfo($file, PATHINFO_FILENAME);
                $fullClass = "Modules\\$moduleName\\Models\\$className";

                if (class_exists($fullClass) && method_exists($fullClass, 'observe')) {
                    $fullClass::observe(BaseModelObserver::class);
                }
            }
        }
    }
}
