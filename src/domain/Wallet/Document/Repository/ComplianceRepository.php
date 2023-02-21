<?php


namespace Wallet\Wallet\Document\Repository;


use Infrastructure\Api\Rest\Client\Event\EventApiClientInterface;
use Infrastructure\Api\Rest\Client\User\Document\ComplianceApiClientInterface;

class ComplianceRepository implements ComplianceRepositoryInterface
{
    /**
     * @var ComplianceApiClientInterface
     */
    private $complianceApiClient;

    /**
     * ComplianceRepository constructor.
     * @param ComplianceApiClientInterface $complianceApiClient
     */
    public function __construct(ComplianceApiClientInterface $complianceApiClient)
    {
        $this->complianceApiClient = $complianceApiClient;
    }

    /**
     * @param string $userId
     * @return array
     */
    public function getUserKyc(string $userId): array
    {
        return $this
            ->complianceApiClient
            ->getUserKyc(
                $userId
            );
    }
}
