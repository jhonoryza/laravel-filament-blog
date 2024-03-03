<?php

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        Model::unguard();
        if ($this->app->environment('production') && !Str::contains(request()->url(), 'local')) {
            URL::forceScheme('https');
        }

        view()->composer('components.layouts.app', function () {
            FilamentColor::register([
                'primary' => Color::Teal,
            ]);
        });
    }
}
