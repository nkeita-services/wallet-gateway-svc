<?php


namespace Infrastructure\Api\Rest\Client\Organization;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Infrastructure\Api\Rest\Client\Organization\Mapper\OrganizationMapperInterface;
use Wallet\Wallet\Organization\Collection\OrganizationCollectionInterface;

class OrganizationApiGuzzleHttpClient implements OrganizationApiClientInterface
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var OrganizationMapperInterface
     */
    private $organizationMapper;

    /**
     * OrganizationApiGuzzleHttpClient constructor.
     * @param Client $guzzleClient
     * @param OrganizationMapperInterface $organizationMapper
     */
    public function __construct(Client $guzzleClient, OrganizationMapperInterface $organizationMapper)
    {
        $this->guzzleClient = $guzzleClient;
        $this->organizationMapper = $organizationMapper;
    }


    /**
     * @inheritDoc
     */
    public function fetchAll(array $filters): OrganizationCollectionInterface
    {
        $response = $this->guzzleClient->get('/v1/organizations', [
            RequestOptions::QUERY => $filters
        ]);

        return $this
            ->organizationMapper
            ->createOrganizationCollectionFromApiResponse(
                $response
            );
    }
}
