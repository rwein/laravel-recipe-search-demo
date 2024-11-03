<?php

namespace App\Providers;

use App\Services\RecipeSlugService;
use App\Services\RecipeSlugServiceInterface;
use App\Services\Search\RecipeSearchService;
use App\Services\Search\RecipeSearchServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RecipeSlugServiceInterface::class, RecipeSlugService::class);
        $this->app->bind(RecipeSearchServiceInterface::class, RecipeSearchService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
