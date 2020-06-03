<?php


namespace Infrastructure\Api\Rest\Client\Plan;


use Infrastructure\Api\Rest\Client\Plan\Exception\WalletPlanNotFoundException;
use Wallet\Account\Entity\AccountEntityInterface;
use Wallet\Wallet\Account\Collection\AccountCollectionInterface;
use Wallet\Wallet\Plan\Collection\PlanCollectionInterface;
use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

interface WalletPlanApiClientInterface
{
    /**
     * @param string $planId
     * @return WalletPlanEntityInterface
     * @throws WalletPlanNotFoundException
     */
    public function get(
        string $planId
    ): WalletPlanEntityInterface;

    /**
     * @param array $filter
     * @return PlanCollectionInterface
     */
    public function fetchAll(
        array $filter
    ): PlanCollectionInterface;

    /**
     * @param array $walletPlanPayload
     * @return WalletPlanEntityInterface
     */
    public function create(
        array $walletPlanPayload
    ): WalletPlanEntityInterface;
}
