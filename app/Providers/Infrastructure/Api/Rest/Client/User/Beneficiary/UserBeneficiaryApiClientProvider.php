<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\User\Beneficiary;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\User\Beneficiary\BeneficiaryApiClient;
use Infrastructure\Api\Rest\Client\User\Beneficiary\BeneficiaryApiClientInterface;
use Infrastructure\Api\Rest\Client\User\Beneficiary\Mapper\UserBeneficiaryMapper;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class UserBeneficiaryApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(BeneficiaryApiClientInterface::class, function ($app) {
            $userServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_USERS_URI');
            return new BeneficiaryApiClient(
                new UserBeneficiaryMapper(),
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
