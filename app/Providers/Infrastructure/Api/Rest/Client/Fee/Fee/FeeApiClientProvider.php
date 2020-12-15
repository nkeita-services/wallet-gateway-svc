<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\Fee\Fee;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Fee\Fee\FeeApiClientInterface;
use Infrastructure\Api\Rest\Client\Fee\Fee\FeeApiGuzzleHttpClient;
use Infrastructure\Api\Rest\Client\Fee\Fee\Mapper\FeeMapper;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class FeeApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(FeeApiClientInterface::class, function ($app) {
            $feeServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_FEES_URI');
            return new FeeApiGuzzleHttpClient(
                new Client([
                    'base_uri' => $feeServiceUri,
                    'headers' => [
                        'Authorization' => sprintf(
                            'Bearer %s',
                            $app->make(OAuthIDTokenServiceInterface::class)->token(
                                $feeServiceUri
                            )
                        )
                    ]
                ]),
                new FeeMapper()
            );
        });
    }
}
