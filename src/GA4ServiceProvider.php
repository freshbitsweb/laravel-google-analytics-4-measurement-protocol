<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol;

use Illuminate\Support\Facades\Blade;
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
        $package->name('laravel-google-analytics-4-measurement-protocol')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('web');
    }

    public function registeringPackage()
    {
        $this->app->bind('ga4', function () {
            return new GA4MeasurementProtocol();
        });
    }

    public function bootingPackage()
    {
        Blade::component('google-analytics-4-measurement-protocol::components.google-analytics-client-id', 'google-analytics-client-id');
    }
}
