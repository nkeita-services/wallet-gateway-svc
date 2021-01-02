<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\Fee\Region;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Fee\Region\Mapper\RegionMapper;
use Infrastructure\Api\Rest\Client\Fee\Region\RegionApiClientInterface;
use Infrastructure\Api\Rest\Client\Fee\Region\RegionApiGuzzleHttpClient;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class RegionApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RegionApiClientInterface::class, function ($app) {
            $regionServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_FEES_URI');
            return new RegionApiGuzzleHttpClient(
                new Client([
                    'base_uri' => $regionServiceUri,
                    'headers' => [
                        'Authorization' => sprintf(
                            'Bearer %s',
                            $app->make(OAuthIDTokenServiceInterface::class)->token(
                                $regionServiceUri
                            )
                        )
                    ]
                ]),
                new RegionMapper()
            );
        });
    }
}
