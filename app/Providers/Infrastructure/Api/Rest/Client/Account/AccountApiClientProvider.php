<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\Account;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Account\AccountApiClientInterface;
use GuzzleHttp\Client;
use Infrastructure\Api\Rest\Client\Account\AccountApiGuzzleHttpClient;
use Infrastructure\Api\Rest\Client\Account\Mapper\AccountMapper;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class AccountApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AccountApiClientInterface::class, function ($app) {
            $accountServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_ACCOUNTS_URI');
            return new AccountApiGuzzleHttpClient(
                new Client([
                    'base_uri' => $accountServiceUri,
                    'headers' => [
                        'Authorization' => sprintf(
                            'Bearer %s',
                            $app->make(OAuthIDTokenServiceInterface::class)->token(
                                $accountServiceUri
                            )
                        )
                    ]
                ]),
                new AccountMapper()
            );
        });
    }
}
