<?php


namespace App\Http\Controllers\Wallet\Fee\Fee\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;

interface FeeMapperInterface
{
    /**
     * @param Request $request
     * @return FeeEntityInterface
     */
    public static function createFeeFromHttpRequest(
        Request $request
    ): FeeEntityInterface;
}
