<?php


namespace App\Providers\Domain\Wallet\Event\Repository;


use Illuminate\Support\ServiceProvider;
use Infrastructure\Api\Rest\Client\Event\EventApiClientInterface;
use Wallet\Wallet\Event\Repository\EventRepository;
use Wallet\Wallet\Event\Repository\EventRepositoryInterface;

class EventRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EventRepositoryInterface::class, function ($app) {
            return new EventRepository(
                $app->make(EventApiClientInterface::class)
            );
        });
    }
}
