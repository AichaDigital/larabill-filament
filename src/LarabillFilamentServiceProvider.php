<?php

namespace AichaDigital\LarabillFilament;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AichaDigital\LarabillFilament\Commands\LarabillFilamentCommand;

class LarabillFilamentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('larabill-filament')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_larabill_filament_table')
            ->hasCommand(LarabillFilamentCommand::class);
    }
}
