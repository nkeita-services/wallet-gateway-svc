<?php


namespace Wallet\Account\Service;


use Wallet\Account\Entity\AccountEntityInterface;

interface AccountServiceInterface
{
    public function create(AccountEntityInterface $accountEntity);
}
