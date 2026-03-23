<?php

namespace Freshbitsweb\LaravelGoogleAnalytics4MeasurementProtocol;

use Closure;
use Exception;
use Illuminate\Support\Facades\Http;

class GA4MeasurementProtocol
{
    /**
     * @var string|Closure
     */
    private $clientId;

    protected string $measurementId;

    protected string $apiSecret;

    private bool $debugging = false;

    /**
     * GA4MeasurementProtocol constructor.
     * @param  string  $measurementId
     * @param  string  $apiSecret
     * @param  string|Closure  $clientId
     */
    public function __construct(string $measurementId, string $apiSecret, $clientId = null)
    {
        $this->measurementId = $measurementId;
        $this->apiSecret = $apiSecret;
        $this->setClientId($clientId ?? static function () {
                throw new Exception('Please specify clientId manually.');
            });
    }

    /**
     * @param string|Closure $clientId
     * @return $this
     */
    public function setClientId($clientId): self
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
        $response = Http::withOptions([
            'query' => [
                'measurement_id' => $this->measurementId,
                'api_secret' => $this->apiSecret,
            ],
        ])->post($this->getRequestUrl(), [
            'client_id' => $this->clientId instanceof Closure ? ($this->clientId)() : $this->clientId,
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
