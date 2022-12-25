<?php


namespace App\Providers\Domain\Wallet\User\Service\Authentification;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Secrets\SecretManagerInterface;
use Wallet\Wallet\User\Service\Authentification\AuthenticationService;
use Wallet\Wallet\User\Service\Authentification\AuthenticationServiceInterface;
use Wallet\Wallet\User\Service\UserServiceInterface;

class AuthenticationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AuthenticationServiceInterface::class, function ($app) {

            return new AuthenticationService(
                $app->make('Aws::Cognito::IdentityProvider'),
                $app->make('Aws::Pinpoint::Provider'),
                $app->make(SecretManagerInterface::class)->get('AWS_COGNITO_USER_POOL_CLIENT_ID'),
                $app->make(SecretManagerInterface::class)->get('AWS_COGNITO_USER_POOL_ID'),
                $app->make(UserServiceInterface::class)
            );
        });
    }
}
