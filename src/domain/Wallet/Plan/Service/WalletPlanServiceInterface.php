<?php


namespace Wallet\Wallet\Plan\Service;


use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

interface WalletPlanServiceInterface
{

    /**
     * @param string $walletPlanId
     * @return WalletPlanEntityInterface
     */
    public function fromWalletPlanId(
        string $walletPlanId
    ): WalletPlanEntityInterface;
}
