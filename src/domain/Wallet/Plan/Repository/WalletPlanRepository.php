<?php


namespace Wallet\Wallet\Plan\Repository;


use Infrastructure\Api\Rest\Client\Plan\WalletPlanApiClientInterface;
use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

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
        return $this
            ->walletPlanApiClient
            ->get(
                $planId
            );
    }
}
