<?php


namespace Wallet\Wallet\Plan\Service;


use Wallet\Wallet\Plan\Collection\PlanCollectionInterface;
use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;
use Wallet\Wallet\Plan\Service\Exception\WalletPlanNotFoundException;

interface WalletPlanServiceInterface
{

    /**
     * @param string $walletPlanId
     * @return WalletPlanEntityInterface
     * @throws WalletPlanNotFoundException
     */
    public function fromWalletPlanId(
        string $walletPlanId
    ): WalletPlanEntityInterface;

    /**
     * @param array $filter
     * @return PlanCollectionInterface
     */
    public function fetchAll(
        array $filter
    ): PlanCollectionInterface;

    /**
     * @param WalletPlanEntityInterface $walletPlanEntity
     * @return WalletPlanEntityInterface
     */
    public function create(
        WalletPlanEntityInterface $walletPlanEntity
    ): WalletPlanEntityInterface;
}
