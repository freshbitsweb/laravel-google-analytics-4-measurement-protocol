<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol;

use Exception;

class GA4MeasurementProtocol
{
    public function __construct()
    {
        if (config('google-analytics-4-measurement-protocol.measurement_id') === null
            || config('google-analytics-4-measurement-protocol.measurement_protocol_api_secret') === null
        ) {
            throw new Exception('Please set .env variables for Google Analytics 4 Measurement Protocol as per the readme file first.');
        }
    }

    public function first()
    {
        return dd(config('google-analytics-4-measurement-protocol'));
    }
}
