<?php


namespace Wallet\Wallet\Transfer\Service;


use Wallet\Wallet\Transfer\Entity\TransferEntityInterface;

interface TransferServiceInterface
{

    /**
     * @param TransferEntityInterface $transferEntity
     * @return mixed
     */
    public function create(
        TransferEntityInterface $transferEntity
    ): TransferEntityInterface;
}
