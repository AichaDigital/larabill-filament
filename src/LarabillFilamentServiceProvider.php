<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LarabillFilamentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('larabill-filament')
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations();
    }
}
