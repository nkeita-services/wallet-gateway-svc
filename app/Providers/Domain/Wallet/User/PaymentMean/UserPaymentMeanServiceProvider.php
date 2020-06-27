<?php


namespace App\Providers\Domain\Wallet\User\PaymentMean;


use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\User\PaymentMean\Repository\UserPaymentMeanRepositoryInterface;
use Wallet\Wallet\User\PaymentMean\Service\UserPaymentMeanService;
use Wallet\Wallet\User\PaymentMean\Service\UserPaymentMeanServiceInterface;

class UserPaymentMeanServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserPaymentMeanServiceInterface::class, function ($app) {
            return new UserPaymentMeanService(
                $app->make(UserPaymentMeanRepositoryInterface::class)
            );
        });
    }
}
