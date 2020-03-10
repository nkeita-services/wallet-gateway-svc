<?php


namespace Wallet\Wallet\Account\Repository;


use Wallet\Account\Entity\AccountEntityInterface;

interface AccountRepositoryInterface
{
    public function create(AccountEntityInterface $accountEntity);
}
