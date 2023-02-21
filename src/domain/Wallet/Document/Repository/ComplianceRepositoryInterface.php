<?php


namespace Wallet\Wallet\Document\Repository;


interface ComplianceRepositoryInterface
{
    /**
     * @param string $userId
     * @return array
     */
    public function getUserKyc(string $userId): array;
}
