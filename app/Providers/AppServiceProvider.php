<?php

namespace App\Providers;

use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Facades\FilamentView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Opcodes\LogViewer\Facades\LogViewer;

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

        $og = new OpenGraphPackage('facebook');
        $og
            ->setTitle(config('meta_tags.title.default'))
            ->setType('website')
            ->setDescription(config('meta_tags.description.default'));
        Meta::registerPackage($og);

        $tw = new TwitterCardPackage('twitter');
        $tw->setTitle(config('meta_tags.title.default'))
            ->setType('website')
            ->setDescription(config('meta_tags.description.default'))
            ->setImage(asset('banner.png'));
        Meta::registerPackage($tw);

        Meta::setFavicon(asset('favicon.png'))
            ->setContentType('website');
    }
}
