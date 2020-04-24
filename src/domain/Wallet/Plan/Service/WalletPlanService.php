<?php


namespace Wallet\Wallet\Plan\Service;


use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;
use Wallet\Wallet\Plan\Repository\WalletPlanRepositoryInterface;
use Wallet\Wallet\Plan\Repository\Exception\WalletPlanNotFoundException as RepositoryWalletPlanNotFoundException;
use Wallet\Wallet\Plan\Service\Exception\WalletPlanNotFoundException;

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
        try {
            return $this->walletPlanRepository->fetchWithPlanId(
                $walletPlanId
            );
        } catch (RepositoryWalletPlanNotFoundException $e) {
            throw new WalletPlanNotFoundException(
                $e->getMessage()
            );
        }
    }
}
