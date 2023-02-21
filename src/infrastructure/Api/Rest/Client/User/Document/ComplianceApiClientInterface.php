<?php


namespace Infrastructure\Api\Rest\Client\User\Document;


interface ComplianceApiClientInterface
{
    /**
     * @param string $userId
     * @return array
     */
    public function getUserKyc(string $userId): array;
}
