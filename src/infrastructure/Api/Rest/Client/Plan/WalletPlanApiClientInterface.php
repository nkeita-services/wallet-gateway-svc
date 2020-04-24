<?php


namespace Infrastructure\Api\Rest\Client\Plan;


use Infrastructure\Api\Rest\Client\Plan\Exception\WalletPlanNotFoundException;
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
}
