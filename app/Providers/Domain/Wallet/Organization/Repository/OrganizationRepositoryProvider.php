<?php


namespace App\Providers\Domain\Wallet\Organization\Repository;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Organization\OrganizationApiClientInterface;
use Wallet\Wallet\Organization\Repository\OrganizationRepository;
use Wallet\Wallet\Organization\Repository\OrganizationRepositoryInterface;

class OrganizationRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(OrganizationRepositoryInterface::class, function ($app) {
            return new OrganizationRepository(
                $app->make(OrganizationApiClientInterface::class)
            );
        });
    }
}
