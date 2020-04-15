<?php


namespace App\Providers\Domain\Wallet\Plan\Repository;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Plan\WalletPlanApiClientInterface;
use Wallet\Wallet\Plan\Repository\WalletPlanRepository;
use Wallet\Wallet\Plan\Repository\WalletPlanRepositoryInterface;

class WalletPlanRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(WalletPlanRepositoryInterface::class, function ($app) {
            return new WalletPlanRepository(
                $app->make(WalletPlanApiClientInterface::class)
            );
        });
    }
}
