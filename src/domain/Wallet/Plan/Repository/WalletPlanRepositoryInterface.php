<?php


namespace Wallet\Wallet\Plan\Repository;


use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

interface WalletPlanRepositoryInterface
{

    /**
     * @param string $planId
     * @return WalletPlanEntityInterface
     */
    public function fetchWithPlanId(
        string $planId
    ): WalletPlanEntityInterface;
}
