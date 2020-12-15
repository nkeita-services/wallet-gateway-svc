<?php


namespace App\Providers\Domain\Wallet\Fee\Fee\Repository;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Fee\Fee\FeeApiClientInterface;
use Wallet\Wallet\Fee\Fee\Repository\FeeRepository;
use Wallet\Wallet\Fee\Fee\Repository\FeeRepositoryInterface;

class FeeRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(FeeRepositoryInterface::class, function ($app) {
            return new FeeRepository(
                $app->make(FeeApiClientInterface::class)
            );
        });
    }
}
