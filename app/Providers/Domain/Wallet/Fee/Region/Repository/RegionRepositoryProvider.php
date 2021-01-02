<?php


namespace App\Providers\Domain\Wallet\Fee\Region\Repository;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Fee\Region\RegionApiClientInterface;
use Wallet\Wallet\Fee\Region\Repository\RegionRepository;
use Wallet\Wallet\Fee\Region\Repository\RegionRepositoryInterface;

class RegionRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RegionRepositoryInterface::class, function ($app) {
            return new RegionRepository(
                $app->make(RegionApiClientInterface::class)
            );
        });
    }
}
