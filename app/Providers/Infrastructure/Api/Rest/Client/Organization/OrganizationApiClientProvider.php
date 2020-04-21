<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\Organization;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Organization\Mapper\OrganizationMapper;
use Infrastructure\Api\Rest\Client\Organization\OrganizationApiClientInterface;
use Infrastructure\Api\Rest\Client\Organization\OrganizationApiGuzzleHttpClient;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class OrganizationApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(OrganizationApiClientInterface::class, function ($app) {
            $organizationServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_ORGANIZATIONS_URI');
            return new OrganizationApiGuzzleHttpClient(
                new Client([
                    'base_uri' => $organizationServiceUri,
                    'headers' => [
                        'Authorization' => sprintf(
                            'Bearer %s',
                            $app->make(OAuthIDTokenServiceInterface::class)->token(
                                $organizationServiceUri
                            )
                        )
                    ]
                ]),
                new OrganizationMapper()
            );
        });
    }
}
