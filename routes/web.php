<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return redirect('/documentation/api/rest/swagger/redoc/index.html');
});

$router->post('v1/wallets/accounts', [
    'uses' => 'Wallet\Account\CreateAccountController@create',
    'middleware'=>'auth'
]);

$router->post('v1/wallets/users', [
    'uses' => 'Wallet\User\CreateUserController@create',
    'middleware'=>'auth'
]);

$router->get('v1/wallets/users/{userId}', [
    'uses' => 'Wallet\User\FetchUserDataController@fetch',
    'middleware'=>'auth'
]);
