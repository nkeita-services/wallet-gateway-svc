<?php


namespace Wallet\Wallet\Organization\Repository;


use Wallet\Wallet\Organization\Entity\OrganizationEntityInterface;

interface OrganizationRepositoryInterface
{

    /**
     * @param string $clientId
     * @return OrganizationEntityInterface
     */
    public function fromClientIdentifier(string $clientId): OrganizationEntityInterface;
}
