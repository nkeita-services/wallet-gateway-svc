<?php


namespace App\Providers\Domain\Wallet\Organization\Service;


use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\Organization\Repository\OrganizationRepositoryInterface;
use Wallet\Wallet\Organization\Service\OrganizationService;
use Wallet\Wallet\Organization\Service\OrganizationServiceInterface;

class OrganizationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(OrganizationServiceInterface::class, function ($app) {
            return new OrganizationService(
                $app->make(OrganizationRepositoryInterface::class)
            );
        });
    }
}
