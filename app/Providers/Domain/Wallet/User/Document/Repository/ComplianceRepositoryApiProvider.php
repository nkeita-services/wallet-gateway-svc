<?php


namespace App\Providers\Domain\Wallet\User\Document\Repository;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\User\Document\ComplianceApiClientInterface;
use Wallet\Wallet\Document\Repository\ComplianceRepository;
use Wallet\Wallet\Document\Repository\ComplianceRepositoryInterface;

class ComplianceRepositoryApiProvider  extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ComplianceRepositoryInterface::class, function ($app) {
            return new ComplianceRepository(
                $app->make(ComplianceApiClientInterface::class)
            );
        });
    }
}

