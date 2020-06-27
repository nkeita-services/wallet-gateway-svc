<?php


namespace App\Http\Controllers\Wallet\User\PaymentMean\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntityInterface;

interface UserPaymentMeanHttpMapperInterface
{
    /**
     * @param Request $request
     * @return PaymentMeanEntityInterface
     */
    public static function createUserPaymentMeanFromHttpRequest(
        Request $request
    ):PaymentMeanEntityInterface;
}
