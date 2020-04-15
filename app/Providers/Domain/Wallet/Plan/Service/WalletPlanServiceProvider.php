<?php


namespace App\Providers\Domain\Wallet\Plan\Service;


use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\Plan\Repository\WalletPlanRepositoryInterface;
use Wallet\Wallet\Plan\Service\WalletPlanService;
use Wallet\Wallet\Plan\Service\WalletPlanServiceInterface;

class WalletPlanServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(WalletPlanServiceInterface::class, function ($app) {
            return new WalletPlanService(
                $app->make(WalletPlanRepositoryInterface::class)
            );
        });
    }
}
