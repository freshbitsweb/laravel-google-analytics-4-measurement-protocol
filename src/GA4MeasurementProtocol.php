<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol;

use Closure;
use Exception;
use Illuminate\Support\Facades\Http;

class GA4MeasurementProtocol
{
    protected string $measurementId;

    protected string $apiSecret;

    protected Closure $clientIdResolver;

    private string $clientId = '';

    private bool $debugging = false;

    public function __construct(string $measurementId, string $apiSecret, Closure $clientIdResolver = null)
    {
        $this->measurementId = $measurementId;
        $this->apiSecret = $apiSecret;
        $this->clientIdResolver = $clientIdResolver ?? static function () {
                throw new Exception('Please set clientId resolver or specify clientId manually.');
            };
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

    public function post(array $payload): array
    {
        $response = Http::withOptions([
            'query' => [
                'measurement_id' => $this->measurementId,
                'api_secret' => $this->apiSecret,
            ],
        ])->post($this->getRequestUrl(), array_merge($payload, [
            'client_id' => $this->clientId ?: ($this->clientIdResolver)(),
        ]));

        if ($this->debugging) {
            return $response->json();
        }

        return [
            'status' => $response->successful(),
        ];
    }

    public function postEvent(array $eventData, array $payload = []): array
    {
        return $this->post(array_merge($payload, [
            'events' => [$eventData],
        ]));
    }

    private function getRequestUrl(): string
    {
        $url = 'https://www.google-analytics.com';
        $url .= $this->debugging ? '/debug' : '';

        return $url.'/mp/collect';
    }
}
