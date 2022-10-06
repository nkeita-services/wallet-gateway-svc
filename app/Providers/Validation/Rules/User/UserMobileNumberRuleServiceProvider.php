<?php


namespace App\Providers\Validation\Rules\User;


use App\Rules\User\UserMobileNumberRule;
use Illuminate\Support\ServiceProvider;
use Wallet\Wallet\User\Service\UserServiceInterface;

class UserMobileNumberRuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserMobileNumberRule::class, function ($app) {
            return new UserMobileNumberRule(
                $app->make(UserServiceInterface::class)
            );
        });
    }

}
