<?php


namespace Infrastructure\Api\Rest\Client\Organization;


use Wallet\Wallet\Organization\Collection\OrganizationCollectionInterface;

interface OrganizationApiClientInterface
{

    /**
     * @param array $filters
     * @return OrganizationCollectionInterface
     */
    public function fetchAll(array $filters): OrganizationCollectionInterface;
}
