<?php


namespace App\Providers\Domain\Wallet\Fee\Quote\Repository;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Fee\Quote\QuoteFeeApiClientInterface;
use Wallet\Wallet\Fee\Quote\Repository\QuoteFeeRepository;
use Wallet\Wallet\Fee\Quote\Repository\QuoteFeeRepositoryInterface;

class QuoteFeeRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(QuoteFeeRepositoryInterface::class, function ($app) {
            return new QuoteFeeRepository(
                $app->make(QuoteFeeApiClientInterface::class)
            );
        });
    }
}
