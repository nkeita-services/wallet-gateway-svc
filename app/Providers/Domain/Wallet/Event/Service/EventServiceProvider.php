<?php


namespace App\Providers\Domain\Wallet\Event\Service;


use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\Event\Repository\EventRepositoryInterface;
use Wallet\Wallet\Event\Service\EventService;
use Wallet\Wallet\Event\Service\EventServiceInterface;

class EventServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EventServiceInterface::class, function ($app) {
            return new EventService(
                $app->make(EventRepositoryInterface::class)
            );
        });
    }
}
