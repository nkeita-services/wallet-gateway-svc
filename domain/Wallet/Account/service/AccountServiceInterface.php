<?php


namespace Wallet\Account\Service;


use Wallet\Account\Entity\AccountEntityInterface;

interface AccountServiceInterface
{
    /**
     * @param AccountEntityInterface $accountEntity
     * @return AccountEntityInterface
     */
    public function create(AccountEntityInterface $accountEntity): AccountEntityInterface;
}
