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

$router->post('v1/wallets/users', [
    'uses' => 'Wallet\User\CreateUserController@create',
    'middleware'=>'auth'
]);

$router->get('v1/wallets/users/{userId}', [
    'uses' => 'Wallet\User\FetchUserDataController@fetch',
    'middleware'=>'auth'
]);

$router->post('v1/wallets/users/{userId}/accounts', [
    'uses' => 'Wallet\Account\CreateAccountController@create',
    'middleware'=>'auth'
]);

$router->get('v1/wallets/users/{userId}/accounts', [
    'uses' => 'Wallet\Account\FetchUserAccountsController@fetch',
    'middleware'=>'auth'
]);

$router->patch('v1/wallets/users/{userId}/accounts/{accountId}', [
    'uses' => 'Wallet\Account\UpdateAccountController@update',
    'middleware'=>'auth'
]);

$router->get('v1/wallets/users/{userId}/accounts/{accountId}', [
    'uses' => 'Wallet\Account\FetchAccountDataController@fetch',
    'middleware'=>'auth'
]);

$router->patch('v1/wallets/users/{userId}/accounts/{accountId}/balance/topUp', [
    'uses' => 'Wallet\Account\UpdateAccountBalanceController@topUp',
    'middleware'=>'auth'
]);

$router->patch('v1/wallets/users/{userId}/accounts/{accountId}/balance/debit', [
    'uses' => 'Wallet\Account\UpdateAccountBalanceController@debit',
    'middleware'=>'auth'
]);

$router->get('v1/wallets/users/{userId}/accounts/{accountId}/transactions', [
    'uses' => 'Wallet\Account\FetchAccountTransactionsController@fetchAll',
    'middleware'=>'auth'
]);
