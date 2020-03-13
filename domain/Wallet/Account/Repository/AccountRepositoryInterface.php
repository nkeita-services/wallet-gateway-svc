<?php


namespace Wallet\Wallet\Account\Repository;


use Wallet\Account\Entity\AccountEntityInterface;

interface AccountRepositoryInterface
{
    /**
     * @param AccountEntityInterface $accountEntity
     * @return AccountEntityInterface
     */
    public function create(AccountEntityInterface $accountEntity): AccountEntityInterface;
}
