<?php


namespace App\Http\Controllers\Wallet\Account\Mapper;


use Illuminate\Http\Request;
use Wallet\Account\Entity\AccountEntityInterface;

interface AccountMapperInterface
{

    public static function createAccountFromHttpRequest(Request $request): AccountEntityInterface;
}
