<?php

namespace BangNokia\FilamentRadioCard;

use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use function Filament\Support\get_color_css_variables;

class ServiceProvider extends PackageServiceProvider
{
    public  static string $name = 'filament-radio-card';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register(
            assets: [
                Css::make('filament-radio-card', __DIR__ . '/../dist/app.css'),
            ],
            package: static::$name
        );
    }
}