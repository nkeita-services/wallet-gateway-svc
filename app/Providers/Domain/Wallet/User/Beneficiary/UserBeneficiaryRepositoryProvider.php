<?php


namespace App\Providers\Domain\Wallet\User\Beneficiary;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\User\Beneficiary\BeneficiaryApiClientInterface;
use Wallet\Wallet\User\Beneficiary\Repository\UserBeneficiaryRepository;
use Wallet\Wallet\User\Beneficiary\Repository\UserBeneficiaryRepositoryInterface;

class UserBeneficiaryRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserBeneficiaryRepositoryInterface::class, function ($app) {
            return new UserBeneficiaryRepository(
                $app->make(BeneficiaryApiClientInterface::class)
            );
        });
    }
}
