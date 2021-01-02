<?php


namespace App\Providers\Domain\Wallet\Fee\Quote\Service;


use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\Fee\Quote\Repository\QuoteFeeRepositoryInterface;
use Wallet\Wallet\Fee\Quote\Service\QuoteFeeService;
use Wallet\Wallet\Fee\Quote\Service\QuoteFeeServiceInterface;

class QuoteFeeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(QuoteFeeServiceInterface::class, function ($app) {;
            return new QuoteFeeService(
                $app->make(QuoteFeeRepositoryInterface::class)
            );
        });
    }
}
