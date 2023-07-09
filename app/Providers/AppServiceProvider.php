<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Navigation;
use App\Models\NastaveniWebu;

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
        $navigationItems = Navigation::all();
        $nastaveniWebu = NastaveniWebu::first();
        View::share('navigationItems', $navigationItems);
        View::share('nastaveniWebu', $nastaveniWebu);
    }
}
