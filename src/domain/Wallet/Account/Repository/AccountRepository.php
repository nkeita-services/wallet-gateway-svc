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
                'organizations' => $organizations,
                'name'=>$accountEntity->getName()
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
    public function fetchWithAccountId(string $accountId): AccountEntityInterface
    {
        return $this
            ->accountApiClient
            ->fetch(
                $accountId
            );
    }

    /**
     * @inheritDoc
     */
    public function topUp(
        string $userId,
        string $accountId,
        array $organizations,
        float $amount
    ): AccountEntityInterface
    {
        $account = $this->fetchWithAccountId($accountId);

        return $this->updateWithUserAndAccountAndOrganizations(
            $userId,
            $accountId,
            $organizations,
            [
                'balance' => $account->getBalance() + $amount
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function debit(
        string $userId,
        string $accountId,
        array $organizations,
        float $amount
    ): AccountEntityInterface
    {
        $account = $this->fetchWithAccountId($accountId);

        return $this->updateWithUserAndAccountAndOrganizations(
            $userId,
            $accountId,
            $organizations,
            [
                'balance' => $account->getBalance() - $amount
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function createOrganizationAccount(
        AccountEntityInterface $accountEntity,
        array $organizations
    ): AccountEntityInterface{
        return $this->accountApiClient->create(
            [
                'accountType' => $accountEntity->getAccountType(),
                'balance' => $accountEntity->getBalance(),
                'walletPlanId' => $accountEntity->getWalletPlanId(),
                'organizations' => $organizations,
                'name'=>$accountEntity->getName()
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function fetchAll(
        array $filter
    ): AccountCollectionInterface{
        return $this->accountApiClient->fetchAll(
            $filter
        );
    }


}
