<?php


namespace Wallet\Wallet\Account\Repository;


use Infrastructure\Api\Rest\Client\Account\AccountApiClientInterface;
use Wallet\Account\Entity\AccountEntityInterface;
use Wallet\Wallet\Account\Collection\AccountCollectionInterface;

class AccountRepository implements AccountRepositoryInterface
{

    /**
     * @var AccountApiClientInterface
     */
    private $accountApiClient;

    public function __construct(AccountApiClientInterface $accountApiClient)
    {
        $this->accountApiClient = $accountApiClient;
    }

    public function create(
        AccountEntityInterface $accountEntity,
        string $userId,
        array $organizations
    ): AccountEntityInterface
    {
        return $this->accountApiClient->create(
            [
                'accountType' => $accountEntity->getAccountType(),
                'balance' => $accountEntity->getBalance(),
                'walletPlanId' => $accountEntity->getWalletPlanId(),
                'userId' => $userId,
                'organizations' => $organizations
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function fetchAllWithUserAndOrganizations(
        string $userId,
        array $organizations
    ): AccountCollectionInterface
    {
        return $this
            ->accountApiClient
            ->fetchAll([
                'userId' => $userId
            ]);
    }

    /**
     * @inheritDoc
     */
    public function updateWithUserAndAccountAndOrganizations(
        string $userId,
        string $accountId,
        array $organizations,
        array $data
    ): AccountEntityInterface
    {
        return $this
            ->accountApiClient
            ->update(
                $accountId,
                $data);
    }

    /**
     * @inheritDoc
     */
    public function fetchWithAccountId(string $accountId)
    {
        return $this
            ->accountApiClient
            ->fetch(
                $accountId
            );
    }


}
