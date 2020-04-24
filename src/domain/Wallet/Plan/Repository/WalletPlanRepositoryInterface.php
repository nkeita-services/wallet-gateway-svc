<?php


namespace Wallet\Wallet\Plan\Repository;


use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;
use Wallet\Wallet\Plan\Repository\Exception\WalletPlanNotFoundException;

interface WalletPlanRepositoryInterface
{

    /**
     * @param string $planId
     * @return WalletPlanEntityInterface
     * @throws WalletPlanNotFoundException
     */
    public function fetchWithPlanId(
        string $planId
    ): WalletPlanEntityInterface;
}
