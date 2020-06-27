<?php


namespace App\Providers\Domain\Wallet\User\PaymentMean;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\User\PaymentMean\UserPaymentMeanApiClientInterface;
use Wallet\Wallet\User\PaymentMean\Repository\UserPaymentMeanRepository;
use Wallet\Wallet\User\PaymentMean\Repository\UserPaymentMeanRepositoryInterface;

class UserPaymentMeanRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserPaymentMeanRepositoryInterface::class, function ($app) {
            return new UserPaymentMeanRepository(
                $app->make(UserPaymentMeanApiClientInterface::class)
            );
        });
    }
}
