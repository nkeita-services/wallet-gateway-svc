<?php


namespace App\Providers\Domain\Wallet\Fee\Fee\Service;


use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\Fee\Fee\Repository\FeeRepositoryInterface;
use Wallet\Wallet\Fee\Fee\Service\FeeService;
use Wallet\Wallet\Fee\Fee\Service\FeeServiceInterface;

class FeeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(FeeServiceInterface::class, function ($app) {
            return new FeeService(
                $app->make(FeeRepositoryInterface::class)
            );
        });
    }
}
