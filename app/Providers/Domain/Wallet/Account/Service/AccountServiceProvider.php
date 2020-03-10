<?php


namespace App\Providers\Domain\Wallet\Account\Service;

use Illuminate\Support\ServiceProvider;
use Wallet\Account\Service\AccountService;
use Wallet\Account\Service\AccountServiceInterface;
use Wallet\Wallet\Account\Repository\AccountRepositoryInterface;

class AccountServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AccountServiceInterface::class, function ($app) {
            return new AccountService(
                $app->make(AccountRepositoryInterface::class)
            );
        });
    }
}

