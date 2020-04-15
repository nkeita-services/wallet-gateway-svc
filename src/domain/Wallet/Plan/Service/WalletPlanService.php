<?php


namespace Wallet\Wallet\Plan\Service;


use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;
use Wallet\Wallet\Plan\Repository\WalletPlanRepositoryInterface;

class WalletPlanService implements WalletPlanServiceInterface
{

    /**
     * @var WalletPlanRepositoryInterface
     */
    private $walletPlanRepository;

    /**
     * WalletPlanService constructor.
     * @param WalletPlanRepositoryInterface $walletPlanRepository
     */
    public function __construct(
        WalletPlanRepositoryInterface $walletPlanRepository
    ){
        $this->walletPlanRepository = $walletPlanRepository;
    }


    /**
     * @inheritDoc
     */
    public function fromWalletPlanId(
        string $walletPlanId
    ): WalletPlanEntityInterface
    {
        return $this->walletPlanRepository->fetchWithPlanId(
            $walletPlanId
        );
    }
}
