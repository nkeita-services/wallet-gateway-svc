<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\User\PaymentMean;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\User\PaymentMean\Mapper\UserUserPaymentMeanMapper;
use Infrastructure\Api\Rest\Client\User\PaymentMean\UserPaymentMeanApiClient;
use Infrastructure\Api\Rest\Client\User\PaymentMean\UserPaymentMeanApiClientInterface;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class UserPaymentMeanApiProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserPaymentMeanApiClientInterface::class, function ($app) {
            $userServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_USERS_URI');
            return new UserPaymentMeanApiClient(
                new UserUserPaymentMeanMapper(),
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
                ])
            );
        });

    }
}

