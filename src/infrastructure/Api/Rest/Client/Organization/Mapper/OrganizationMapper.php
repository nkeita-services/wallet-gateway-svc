<?php


namespace Infrastructure\Api\Rest\Client\Organization\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Organization\Collection\OrganizationCollection;
use Wallet\Wallet\Organization\Collection\OrganizationCollectionInterface;

class OrganizationMapper implements OrganizationMapperInterface
{

    /**
     * @inheritDoc
     */
    public function createOrganizationCollectionFromApiResponse(
        ResponseInterface $response
    ): OrganizationCollectionInterface{
        $data = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return OrganizationCollection::fromArray(
            $data['data']['WalletOrganizations']
        );
    }
}
