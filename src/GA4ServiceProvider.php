<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol;

use Exception;
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

    public function registeringPackage(): void
    {
        $this->app->bind('ga4', function () {
            if (config('google-analytics-4-measurement-protocol.measurement_id') === null
                || config('google-analytics-4-measurement-protocol.api_secret') === null
            ) {
                throw new Exception('Please set .env variables for Google Analytics 4 Measurement Protocol as per the readme file first.');
            }

            return new GA4MeasurementProtocol(
                config('google-analytics-4-measurement-protocol.measurement_id'),
                config('google-analytics-4-measurement-protocol.api_secret'),
                function () {
                    $clientId = session(config('google-analytics-4-measurement-protocol.client_id_session_key'));
                    if (empty($clientId)) {
                        throw new Exception('Please use the package provided blade directive or set client_id manually before posting an event.');
                    }

                    return $clientId;
                }
            );
        });
    }

    public function bootingPackage(): void
    {
        Blade::component('google-analytics-4-measurement-protocol::components.google-analytics-client-id', 'google-analytics-client-id');
    }
}
