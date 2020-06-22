<?php


namespace App\Http\Controllers\Wallet\Remittances\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\Transfer\Entity\TransferEntityInterface;

interface TransferMapperInterface
{

    /**
     * @param Request $request
     * @return TransferEntityInterface
     */
    public static function createTransferFromHttpRequest(Request $request): TransferEntityInterface;
}
