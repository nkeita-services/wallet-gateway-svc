<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\Organization;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Organization\Mapper\OrganizationMapper;
use Infrastructure\Api\Rest\Client\Organization\OrganizationApiClientInterface;
use Infrastructure\Api\Rest\Client\Organization\OrganizationApiGuzzleHttpClient;

class OrganizationApiClientProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(OrganizationApiClientInterface::class, function ($app) {
            return new OrganizationApiGuzzleHttpClient(
                new Client([
                    'base_uri' => 'https://wallet-organization-svc-py-fjhmnd5asa-ew.a.run.app'
                ]),
                new OrganizationMapper()
            );
        });
    }
}
