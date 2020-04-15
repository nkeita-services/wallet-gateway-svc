<?php


namespace Infrastructure\Api\Rest\Client\Plan;


use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

interface WalletPlanApiClientInterface
{
    /**
     * @param string $planId
     * @return WalletPlanEntityInterface
     */
    public function get(
        string $planId
    ): WalletPlanEntityInterface;
}
