<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\Fee\Quote;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Fee\Quote\Mapper\QuoteFeeMapper;
use Infrastructure\Api\Rest\Client\Fee\Quote\QuoteFeeApiClientInterface;
use Infrastructure\Api\Rest\Client\Fee\Quote\QuoteFeeApiGuzzleHttpClient;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class QuoteFeeApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(QuoteFeeApiClientInterface::class, function ($app) {
            $quoteFeeServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_FEES_URI');
            return new QuoteFeeApiGuzzleHttpClient(
                new Client([
                    'base_uri' => $quoteFeeServiceUri,
                    'headers' => [
                        'Authorization' => sprintf(
                            'Bearer %s',
                            $app->make(OAuthIDTokenServiceInterface::class)->token(
                                $quoteFeeServiceUri
                            )
                        )
                    ]
                ]),
                new QuoteFeeMapper()
            );
        });
    }
}
