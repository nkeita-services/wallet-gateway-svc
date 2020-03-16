<?php


namespace Wallet\Wallet\Account\Repository;


use Wallet\Account\Entity\AccountEntityInterface;

interface AccountRepositoryInterface
{
    /**
     * @param AccountEntityInterface $accountEntity
     * @param string $userId
     * @param array $organizations
     * @return AccountEntityInterface
     */
    public function create(
        AccountEntityInterface $accountEntity,
        string $userId,
        array $organizations
    ): AccountEntityInterface;


    public function fetchAll(
        string $userId
    );
}
