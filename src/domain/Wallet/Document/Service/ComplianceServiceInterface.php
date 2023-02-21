<?php


namespace Wallet\Wallet\Document\Service;


interface ComplianceServiceInterface
{
    /**
     * @param string $userId
     * @return array
     */
    public function getUserKyc(string $userId): array;
}
