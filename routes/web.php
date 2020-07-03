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

$router->get('v1/wallets/users', [
    'uses' => 'Wallet\User\FetchAllUsersController@fetchAll',
    'middleware'=>'auth',
    'as'=>'wallet-gateway/ListUsers',
    'groups'=> [
        'root',
        'admin'
    ]
]);

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

$router->get('v1/wallets/organizations', [
    'uses' => 'Wallet\Organization\FetchOrganizationDataController@fetchData',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/FetchOrganizationData",
    'groups'=> [
        'root',
        'admin'
    ]
]);

$router->post('v1/wallets/organizations/accounts', [
    'uses' => 'Wallet\Organization\Account\CreateAccountController@create',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/CreateOrganizationAccount",
    'groups'=> [
        'root',
        'admin'
    ]
]);

$router->get('v1/wallets/organizations/accounts', [
    'uses' => 'Wallet\Organization\Account\FetchAccountsController@fetchAll',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/ListOrganizationAccounts",
    'groups'=> [
        'root',
        'admin'
    ]
]);

$router->get('v1/wallets/organizations/accounts/{accountId}', [
    'uses' => 'Wallet\Organization\Account\GetAccountDataController@fetch',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/GetOrganizationAccount",
    'groups'=> [
        'root',
        'admin'
    ]
]);

$router->get('v1/wallets/organizations/accounts/{accountId}/transactions', [
    'uses' => 'Wallet\Organization\Account\FetchAccountTransactionsController@fetchAll',
    'middleware'=>'auth',
    'as'=>"wallet-gateway/GetOrganizationAccountTransactions",
    'groups'=> [
        'root',
        'admin'
    ]
]);

$router->post('v1/wallets/remittances', [
    'uses' => 'Wallet\Remittances\CreateTransferController@create',
    'middleware'=>'auth',
    'as'=>'wallet-gateway/CreateUsers',
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);


$router->get('/v1/wallets/users/{userId}/beneficiaries', [
    'uses' => 'Wallet\User\Beneficiary\FetchAllUserBeneficiariesController@fetchAll',
    'middleware'=>'auth',
    'as'=>'wallet-gateway/ListUserBeneficiaries',
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->post('/v1/wallets/users/{userId}/beneficiaries', [
    'uses' => 'Wallet\User\Beneficiary\CreateBeneficiaryController@create',
    'middleware'=>'auth',
    'as'=>'wallet-gateway/CreateUserBeneficiary',
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->get('/v1/wallets/users/{userId}/payment-means', [
    'uses' => 'Wallet\User\PaymentMean\FetchAllPaymentMeansController@fetchAll',
    'middleware'=>'auth',
    'as'=>'wallet-gateway/ListPaymentMeans',
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->get('/v1/wallets/users/{userId}/payment-means/{paymentMeanId}', [
    'uses' => 'Wallet\User\PaymentMean\FetchPaymentMeanDataController@fetchAll',
    'middleware'=>'auth',
    'as'=>'wallet-gateway/GetPaymentMean',
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

$router->post('/v1/wallets/users/{userId}/payment-means', [
    'uses' => 'Wallet\User\PaymentMean\CreatePaymentMeanController@create',
    'middleware'=>'auth',
    'as'=>'wallet-gateway/CreatePaymentMeans',
    'groups'=> [
        'root',
        'admin',
        'user'
    ]
]);

