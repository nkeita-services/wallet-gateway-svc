<?php


require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

use App\Providers\Infrastructure\Api\Rest\Client\Account\AccountApiClientProvider;
use App\Providers\Domain\Wallet\Account\Service\AccountServiceProvider;
use App\Providers\Domain\Wallet\Account\Respository\AccountRepositoryProvider;
use App\Providers\Infrastructure\Api\Rest\Client\User\UserApiClientProvider;
use App\Providers\Domain\Wallet\User\Repository\UserRepositoryProvider;
use App\Providers\Domain\Wallet\User\Service\UserServiceProvider;
use App\Http\Middleware\OAuth2ClientCredentials;
use App\Providers\Infrastructure\Api\Rest\Client\Event\EventApiClientProvider;
use App\Providers\Domain\Wallet\Event\Repository\EventRepositoryProvider;
use App\Providers\Domain\Wallet\Event\Service\EventServiceProvider;
use App\Providers\Domain\Wallet\Account\Service\AccountTransactionServiceProvider;
use App\Providers\Infrastructure\Api\Rest\Client\Organization\OrganizationApiClientProvider;
use App\Providers\Domain\Wallet\Organization\Repository\OrganizationRepositoryProvider;
use App\Providers\Domain\Wallet\Organization\Service\OrganizationServiceProvider;
use App\Providers\Infrastructure\Api\Rest\Client\Wallet\WalletPlanApiClientProvider;
use App\Providers\Domain\Wallet\Plan\Repository\WalletPlanRepositoryProvider;
use App\Providers\Domain\Wallet\Plan\Service\WalletPlanServiceProvider;
use App\Providers\Infrastructure\CloudRun\Metadata\CloudRunMetadataGuzzleClientProvider;
use App\Providers\Infrastructure\CloudRun\Metadata\OAuth\IDToken\OAuthIDTokenServiceProvider;
use App\Providers\Infrastructure\CloudRun\Metadata\ProjectID\CloudRunProjectIDServiceProvider;
use App\Providers\Infrastructure\Secrets\SecretManagerServiceProvider;
use App\Providers\Validation\Rules\Wallet\WalletPlanIdRuleServiceProvider;
use App\Providers\Validation\Rules\Wallet\WalletUserIdRuleServiceProvider;
use Nord\Lumen\Cors\CorsServiceProvider;
use Nord\Lumen\Cors\CorsMiddleware;
use App\Providers\Infrastructure\Api\Rest\Client\User\Beneficiary\UserBeneficiaryApiClientProvider;
use App\Providers\Domain\Wallet\User\Beneficiary\UserBeneficiaryRepositoryProvider;
use App\Providers\Domain\Wallet\User\Beneficiary\UserBeneficiaryServiceProvider;
use App\Providers\Infrastructure\Api\Rest\Client\User\PaymentMean\UserPaymentMeanApiProvider;
/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

 $app->withFacades();

// $app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->routeMiddleware([
    'auth' => OAuth2ClientCredentials::class,
]);

$app->middleware([
    CorsMiddleware::class
]);
/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/
$app->register(CorsServiceProvider::class);
$app->register(AccountApiClientProvider::class);
$app->register(AccountServiceProvider::class);
$app->register(AccountRepositoryProvider::class);

$app->register(UserApiClientProvider::class);
$app->register(UserRepositoryProvider::class);
$app->register(UserServiceProvider::class);

$app->register(EventApiClientProvider::class);
$app->register(EventRepositoryProvider::class);
$app->register(EventServiceProvider::class);

$app->register(AccountTransactionServiceProvider::class);

$app->register(OrganizationApiClientProvider::class);

$app->register(OrganizationRepositoryProvider::class);
$app->register(OrganizationServiceProvider::class);

$app->register(WalletPlanApiClientProvider::class);
$app->register(WalletPlanRepositoryProvider::class);
$app->register(WalletPlanServiceProvider::class);

$app->register(CloudRunProjectIDServiceProvider::class);
$app->register(SecretManagerServiceProvider::class);

$app->register(OAuthIDTokenServiceProvider::class);
$app->register(CloudRunMetadataGuzzleClientProvider::class);

$app->register(WalletPlanIdRuleServiceProvider::class);
$app->register(WalletUserIdRuleServiceProvider::class);

$app->register(UserBeneficiaryApiClientProvider::class);
$app->register(UserBeneficiaryRepositoryProvider::class);
$app->register(UserBeneficiaryServiceProvider::class);

$app->register(UserPaymentMeanApiProvider::class);

//$app->register(\App\Providers\AuthServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__ . '/../routes/web.php';
});

return $app;
