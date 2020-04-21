<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\User;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\User\Mapper\UserMapper;
use Infrastructure\Api\Rest\Client\User\UserApiClientInterface;
use Infrastructure\Api\Rest\Client\User\UserApiGuzzleHttpClient;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class UserApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserApiClientInterface::class, function ($app) {
            $userServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_USERS_URI');
            return new UserApiGuzzleHttpClient(
                new Client([
                    'base_uri' => $userServiceUri,
                    'headers' => [
                        'Authorization' => sprintf(
                            'Bearer %s',
                            $app->make(OAuthIDTokenServiceInterface::class)->token(
                                $userServiceUri
                            )
                        )
                    ]
                ]),
                new UserMapper()
            );
        });

    }
}
