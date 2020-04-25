<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\Event;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Event\EventApiClientInterface;
use Infrastructure\Api\Rest\Client\Event\EventApiGuzzleHttpClient;
use GuzzleHttp\Client;
use Infrastructure\Api\Rest\Client\Event\Mapper\EventMapper;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class EventApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EventApiClientInterface::class, function ($app) {
            $eventStoreServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_EVENTS_URI');
            return new EventApiGuzzleHttpClient(
                new Client([
                    'base_uri' => $eventStoreServiceUri,
                    'headers' => [
                        'Authorization' => sprintf(
                            'Bearer %s',
                            $app->make(OAuthIDTokenServiceInterface::class)->token(
                                $eventStoreServiceUri
                            )
                        )
                    ]
                ]),
                new EventMapper()
            );
        });
    }
}
