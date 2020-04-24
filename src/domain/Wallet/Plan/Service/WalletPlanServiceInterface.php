<?php


namespace Wallet\Wallet\Plan\Service;


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
}
