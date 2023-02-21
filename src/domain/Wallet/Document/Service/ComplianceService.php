<?php


namespace Wallet\Wallet\Document\Service;


use Wallet\Wallet\Document\Repository\ComplianceRepositoryInterface;

class ComplianceService implements ComplianceServiceInterface
{
    /**
     * @var ComplianceRepositoryInterface
     */
    private $complianceRepository;

    /**
     * ComplianceService constructor.
     * @param ComplianceRepositoryInterface $complianceRepository
     */
    public function __construct(ComplianceRepositoryInterface $complianceRepository)
    {
        $this->complianceRepository = $complianceRepository;
    }

    /**
     * @param string $userId
     * @return array
     */
    public function getUserKyc(string $userId): array
    {
        return $this
            ->complianceRepository
            ->getUserKyc(
                $userId
            );
    }
}
