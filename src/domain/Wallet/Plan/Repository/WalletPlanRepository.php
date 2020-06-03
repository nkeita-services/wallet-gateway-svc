<?php


namespace Wallet\Wallet\Plan\Repository;


use Infrastructure\Api\Rest\Client\Plan\Exception\WalletPlanNotFoundException as ApiWalletPlanNotFoundException;
use Infrastructure\Api\Rest\Client\Plan\WalletPlanApiClientInterface;
use Wallet\Wallet\Plan\Collection\PlanCollectionInterface;
use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;
use Wallet\Wallet\Plan\Repository\Exception\WalletPlanNotFoundException;

class WalletPlanRepository implements WalletPlanRepositoryInterface
{

    /**
     * @var WalletPlanApiClientInterface
     */
    private $walletPlanApiClient;

    /**
     * WalletPlanRepository constructor.
     * @param WalletPlanApiClientInterface $walletPlanApiClient
     */
    public function __construct(
        WalletPlanApiClientInterface $walletPlanApiClient
    ){
        $this->walletPlanApiClient = $walletPlanApiClient;
    }


    /**
     * @inheritDoc
     */
    public function fetchWithPlanId(
        string $planId
    ): WalletPlanEntityInterface{
        try {
            return $this
                ->walletPlanApiClient
                ->get(
                    $planId
                );
        } catch (ApiWalletPlanNotFoundException $e) {
            throw new WalletPlanNotFoundException(
                $e->getMessage()
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function fetchAll(
        array $filter
    ): PlanCollectionInterface
    {
        return $this
            ->walletPlanApiClient
            ->fetchAll($filter);
    }

    /**
     * @inheritDoc
     */
    public function create(
        WalletPlanEntityInterface $walletPlanEntity
    ): WalletPlanEntityInterface{
        return $this
            ->walletPlanApiClient
            ->create(
                $walletPlanEntity->toArray()
            );
    }


}
