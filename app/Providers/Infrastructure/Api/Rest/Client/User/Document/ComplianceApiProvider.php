<?php


namespace App\Providers\Infrastructure\Api\Rest\Client\User\Document;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\User\Document\ComplianceApiClientInterface;
use Infrastructure\Api\Rest\Client\User\Document\ComplianceApiGuzzleHttpClient;
use Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceInterface;
use Infrastructure\Secrets\SecretManagerInterface;

class ComplianceApiProvider  extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ComplianceApiClientInterface::class, function ($app) {
            $userServiceUri = $app->make(SecretManagerInterface::class)->get('WALLET_BACKEND_COMPLIANCE_URI');
            return new ComplianceApiGuzzleHttpClient(
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
