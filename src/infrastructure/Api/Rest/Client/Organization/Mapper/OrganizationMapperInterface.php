<?php


namespace Infrastructure\Api\Rest\Client\Organization\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Organization\Collection\OrganizationCollectionInterface;

interface OrganizationMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return OrganizationCollectionInterface
     */
    public function createOrganizationCollectionFromApiResponse(
        ResponseInterface $response
    ):OrganizationCollectionInterface;
}
