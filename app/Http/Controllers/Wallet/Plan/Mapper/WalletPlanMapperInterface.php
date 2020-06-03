<?php


namespace App\Http\Controllers\Wallet\Plan\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

interface WalletPlanMapperInterface
{
    /**
     * @param Request $request
     * @return WalletPlanEntityInterface
     */
    public static function createWalletPlanFromHttpRequest(Request $request): WalletPlanEntityInterface;
}
