<?php


namespace App\Providers\Domain\Wallet\User\Repository;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\User\UserApiClientInterface;
use Wallet\Wallet\User\Repository\UserRepository;
use Wallet\Wallet\User\Repository\UserRepositoryInterface;

class UserRepositoryProvider  extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, function ($app) {
            return new UserRepository(
                $app->make(UserApiClientInterface::class)
            );
        });
    }
}
