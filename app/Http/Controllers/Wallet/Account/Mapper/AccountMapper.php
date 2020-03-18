<?php


namespace App\Http\Controllers\Wallet\Account\Mapper;


use Illuminate\Http\Request;
use Wallet\Account\Entity\AccountEntity;
use Wallet\Account\Entity\AccountEntityInterface;

class AccountMapper implements AccountMapperInterface
{

    public static function createAccountFromHttpRequest(Request $request): AccountEntityInterface
    {
        $payload =  $request->json()->all();

        return AccountEntity::fromArray(
           [
               'accountType' => $payload['accountType'],
               'balance' => $payload['balance'],
               'walletPlanId'=> $payload['walletPlanId']
           ]
        );
    }


}
