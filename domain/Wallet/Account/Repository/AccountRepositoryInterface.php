<?php


namespace Wallet\Wallet\Account\Repository;


use Wallet\Account\Entity\AccountEntityInterface;
use Wallet\Wallet\Account\Collection\AccountCollectionInterface;

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


    /**
     * @param string $userId
     * @param array $organizations
     * @return AccountCollectionInterface
     */
    public function fetchAllWithUserAndOrganizations(
        string $userId,
        array $organizations
    ): AccountCollectionInterface;

    /**
     * @param string $userId
     * @param string $accountId
     * @param array $organizations
     * @param array $data
     * @return AccountEntityInterface
     */
    public function updateWithUserAndAccountAndOrganizations(
        string $userId,
        string $accountId,
        array $organizations,
        array $data
    ): AccountEntityInterface;

    /**
     * @param string $accountId
     * @return mixed
     */
    public function fetchWithAccountId(
        string $accountId
    );
}
