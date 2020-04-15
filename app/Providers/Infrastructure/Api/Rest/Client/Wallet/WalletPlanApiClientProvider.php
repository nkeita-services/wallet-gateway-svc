<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\Wallet;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Plan\Mapper\WalletPlanMapper;
use Infrastructure\Api\Rest\Client\Plan\WalletPlanApiClientInterface;
use Infrastructure\Api\Rest\Client\Plan\WalletPlanApiGuzzleHttpClient;

class WalletPlanApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(WalletPlanApiClientInterface::class, function ($app) {
            return new WalletPlanApiGuzzleHttpClient(
                new Client([
                    'base_uri' => 'https://wallet-plan-svc-py-fjhmnd5asa-ew.a.run.app'
                ]),
                new WalletPlanMapper()
            );
        });
    }
}
