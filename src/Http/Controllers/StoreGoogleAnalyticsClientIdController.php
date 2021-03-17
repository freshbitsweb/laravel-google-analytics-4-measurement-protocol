<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol\Http\Controllers;

class StoreGoogleAnalyticsClientIdController
{
    public function __invoke(): void
    {
        session([config('google-analytics-4-measurement-protocol.client_id_session_key') => request('client_id')]);
    }
}
