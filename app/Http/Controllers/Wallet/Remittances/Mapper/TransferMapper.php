<?php


namespace App\Http\Controllers\Wallet\Remittances\Mapper;


use Illuminate\Http\Request;
use Wallet\Wallet\Transfer\Entity\TransferEntity;
use Wallet\Wallet\Transfer\Entity\TransferEntityInterface;

class TransferMapper implements TransferMapperInterface
{

    /**
     * @inheritDoc
     */
    public static function createTransferFromHttpRequest(
        Request $request
    ): TransferEntityInterface{
        return TransferEntity::fromArray(
            $request->json()->all()
        );
    }
}
