<?php
// Modified by Claude

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

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
        Schema::defaultStringLength(191); // Limite la taille par défaut des colonnes string
        
        // Prevent lazy loading in non-production environments
        // This helps detect N+1 query problems during development
        Model::preventLazyLoading(! app()->isProduction());
        
        // Optional: Handle violation of lazy loading
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            $class = get_class($model);
            info("Attempted to lazy load [{$relation}] on model [{$class}].");
        });
    }
}
