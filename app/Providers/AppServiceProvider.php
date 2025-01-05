<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Facades\FilamentView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Opcodes\LogViewer\Facades\LogViewer;
use PharIo\Manifest\Author;

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
        if ($this->app->environment('production') && ! Str::contains(request()->url(), 'local')) {
            URL::forceScheme('https');
        }

        view()->composer('components.layouts.app', function () {
            FilamentColor::register([
                'primary' => Color::Teal,
            ]);
        });

        LogViewer::auth(function () {
            return true;
        });

        FilamentView::spa();

        Route::bind('author', function ($value) {
            return User::query()
                ->where('name', $value)
                ->firstOrFail();
        });

        Route::bind('post', function ($value) {
            return Post::query()
                ->whereNotNull('published_at')
                ->where('slug', $value)
                ->firstOrFail();
        });
    }
}
