<?php


namespace App\Providers\Validation\Rules\User;


use App\Rules\User\UserEmailRule;
use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\User\Service\UserServiceInterface;

class UserEmailRuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserEmailRule::class, function ($app) {
            return new UserEmailRule(
                $app->make(UserServiceInterface::class)
            );
        });
    }
}
