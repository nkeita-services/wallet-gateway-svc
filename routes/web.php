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
    'middleware'=>'auth',
    'as'=>'wallet-gateway/CreateUsers',
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->get('v1/wallets/users/{userId}', [
    'uses' => 'Wallet\User\FetchUserDataController@fetch',
    'middleware'=>'auth',
    'as'=>'wallet-gateway/GetUser',
    'groups'=> [
        'root',
        'admin',
        //'user'
    ]
]);

$router->post('v1/wallets/users/{userId}/accounts', [
    'uses' => 'Wallet\Account\CreateAccountController@create',
    'middleware'=>'auth',
    'as'=>'wallet-gateway/CreateAccounts',
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->get('v1/wallets/users/{userId}/accounts', [
    'uses' => 'Wallet\Account\FetchUserAccountsController@fetch',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/ListUserAccounts",
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->patch('v1/wallets/users/{userId}/accounts/{accountId}', [
    'uses' => 'Wallet\Account\UpdateAccountController@update',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/UpdateAccountInfo",
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->get('v1/wallets/users/{userId}/accounts/{accountId}', [
    'uses' => 'Wallet\Account\FetchAccountDataController@fetch',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/GetAccountInfo",
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->patch('v1/wallets/users/{userId}/accounts/{accountId}/balance/topUp', [
    'uses' => 'Wallet\Account\UpdateAccountBalanceController@topUp',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/TopUpAccount",
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->patch('v1/wallets/users/{userId}/accounts/{accountId}/balance/debit', [
    'uses' => 'Wallet\Account\UpdateAccountBalanceController@debit',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/DebitAccount",
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->get('v1/wallets/users/{userId}/accounts/{accountId}/transactions', [
    'uses' => 'Wallet\Account\FetchAccountTransactionsController@fetchAll',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/GetAccountTransactions",
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->get('v1/wallets/plans/{planId}', [
    'uses' => 'Wallet\Plan\FetchWalletPlanDataController@fetch',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/GetWalletPlan",
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->get('v1/wallets/plans', [
    'uses' => 'Wallet\Plan\FetchAllWalletPlansController@fetchAll',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/FetchAllWalletPlans",
    'groups'=> [
        'root',
        'admin'
    ]
]);

$router->post('v1/wallets/plans', [
    'uses' => 'Wallet\Plan\CreateWalletPlanController@create',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/CreateWalletPlan",
    'groups'=> [
        'root',
        'admin'
    ]
]);
