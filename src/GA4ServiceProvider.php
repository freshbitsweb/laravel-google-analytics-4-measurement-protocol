<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GA4ServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('laravel-google-analytics-4-measurement-protocol');

        // Next step is to do config part
    }

    public function registeringPackage()
    {
        $this->app->bind('ga4', function () {
            return new GA4Facade();
        });
    }
}
