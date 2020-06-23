<?php


namespace App\Providers\Domain\Wallet\User\Beneficiary;


use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\User\Beneficiary\Repository\UserBeneficiaryRepositoryInterface;
use Wallet\Wallet\User\Beneficiary\Service\UserBeneficiaryService;
use Wallet\Wallet\User\Beneficiary\Service\UserBeneficiaryServiceInterface;

class UserBeneficiaryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserBeneficiaryServiceInterface::class, function ($app) {
            return new UserBeneficiaryService(
                $app->make(UserBeneficiaryRepositoryInterface::class)
            );
        });
    }
}
