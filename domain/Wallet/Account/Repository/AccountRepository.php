<?php


namespace Wallet\Wallet\Account\Repository;


use Infrastructure\Api\Rest\Client\Account\AccountApiClientInterface;
use Wallet\Account\Entity\AccountEntityInterface;

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
}
