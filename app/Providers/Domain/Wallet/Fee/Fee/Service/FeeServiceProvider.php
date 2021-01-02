<?php


namespace App\Providers\Domain\Wallet\Fee\Fee\Service;


use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\Fee\Region\Repository\RegionRepositoryInterface;
use Wallet\Wallet\Fee\Region\Service\RegionService;
use Wallet\Wallet\Fee\Region\Service\RegionServiceInterface;

class FeeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RegionServiceInterface::class, function ($app) {
            return new RegionService(
                $app->make(RegionRepositoryInterface::class)
            );
        });
    }
}
