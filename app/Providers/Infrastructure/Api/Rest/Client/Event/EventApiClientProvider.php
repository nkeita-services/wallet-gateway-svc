<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\Event;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Event\EventApiClientInterface;
use Infrastructure\Api\Rest\Client\Event\EventApiGuzzleHttpClient;
use GuzzleHttp\Client;
use Infrastructure\Api\Rest\Client\Event\Mapper\EventMapper;

class EventApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EventApiClientInterface::class, function ($app) {
            return new EventApiGuzzleHttpClient(
                new Client([
                    'base_uri' => 'https://wallet-event-store-svc-py-fjhmnd5asa-ew.a.run.app'
                ]),
                new EventMapper()
            );
        });
    }
}
