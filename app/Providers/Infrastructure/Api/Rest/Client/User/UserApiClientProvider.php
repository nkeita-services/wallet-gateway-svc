<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\User;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\User\Mapper\UserMapper;
use Infrastructure\Api\Rest\Client\User\UserApiClientInterface;
use Infrastructure\Api\Rest\Client\User\UserApiGuzzleHttpClient;

class UserApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserApiClientInterface::class, function ($app) {
            return new UserApiGuzzleHttpClient(
                new Client([
                    'base_uri' => 'https://wallet-account-user-svc-py-fjhmnd5asa-ew.a.run.app'
                ]),
                new UserMapper()
            );
        });
    }
}
