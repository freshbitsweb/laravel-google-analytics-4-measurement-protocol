<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol;

use Exception;
use Illuminate\Support\Facades\Http;

class GA4MeasurementProtocol
{
    private string $clientId = '';

    private bool $debugging = false;

    public function __construct()
    {
        if (config('google-analytics-4-measurement-protocol.measurement_id') === null
            || config('google-analytics-4-measurement-protocol.api_secret') === null
        ) {
            throw new Exception('Please set .env variables for Google Analytics 4 Measurement Protocol as per the readme file first.');
        }
    }

    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function enableDebugging(): self
    {
        $this->debugging = true;

        return $this;
    }

    public function postEvent(array $eventData): array
    {
        if (!$this->clientId && !$this->clientId = session(config('google-analytics-4-measurement-protocol.client_id_session_key'))) {
            throw new Exception('Please use the package provided blade directive or set client_id manually before posting an event.');
        }

        $response = Http::withOptions([
            'query' => [
                'measurement_id' => config('google-analytics-4-measurement-protocol.measurement_id'),
                'api_secret' => config('google-analytics-4-measurement-protocol.api_secret'),
            ],
        ])->post($this->getRequestUrl(), [
            'client_id' => $this->clientId,
            'events' => [$eventData],
        ]);

        if ($this->debugging) {
            return $response->json();
        }

        return [
            'status' => $response->successful()
        ];
    }

    private function getRequestUrl(): string
    {
        $url = 'https://www.google-analytics.com';
        $url .= $this->debugging ? '/debug' : '';

        return $url.'/mp/collect';
    }
}
