<?php


namespace App\Providers\Domain\Wallet\User\Document\Service;


use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\Document\Repository\ComplianceRepositoryInterface;
use Wallet\Wallet\Document\Service\ComplianceService;
use Wallet\Wallet\Document\Service\ComplianceServiceInterface;

class ComplianceServiceApiProvider  extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ComplianceServiceInterface::class, function ($app) {
            return new ComplianceService(
                $app->make(ComplianceRepositoryInterface::class)
            );
        });
    }
}
