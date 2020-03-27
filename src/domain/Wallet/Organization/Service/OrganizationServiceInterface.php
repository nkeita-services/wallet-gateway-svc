<?php


namespace Wallet\Wallet\Organization\Service;


use Wallet\Wallet\Organization\Entity\OrganizationEntityInterface;

interface OrganizationServiceInterface
{
    /**
     * @param string $clientId
     * @return OrganizationEntityInterface
     */
    public function fromClientIdentifier(string $clientId): OrganizationEntityInterface;
}
