<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\Wallet;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Plan\Mapper\WalletPlanMapper;
use Infrastructure\Api\Rest\Client\Plan\WalletPlanApiClientInterface;
use Infrastructure\Api\Rest\Client\Plan\WalletPlanApiGuzzleHttpClient;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class WalletPlanApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(WalletPlanApiClientInterface::class, function ($app) {

            $walletPlanServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_PLANS_URI');
            return new WalletPlanApiGuzzleHttpClient(
                new Client([
                    'base_uri' => $walletPlanServiceUri,
                    'headers' => [
                        'Authorization' => sprintf(
                            'Bearer %s',
                            $app->make(OAuthIDTokenServiceInterface::class)->token(
                                $walletPlanServiceUri
                            )
                        )
                    ]
                ]),
                new WalletPlanMapper()
            );
        });
    }
}
