<?php


namespace App\Http\Controllers\Wallet\Fee\Quote\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Transaction\TransactionEntityInterface;

interface QuoteFeeMapperInterface
{
    /**
     * @param Request $request
     * @return TransactionEntityInterface
     */
    public static function createQuoteFeeFromHttpRequest(
        Request $request): TransactionEntityInterface;
}
