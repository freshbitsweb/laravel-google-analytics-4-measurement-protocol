<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol;

use Illuminate\Support\Facades\Facade;

class GA4Facade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ga4';
    }
}
