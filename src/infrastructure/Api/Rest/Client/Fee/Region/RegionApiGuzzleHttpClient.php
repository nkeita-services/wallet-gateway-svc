<?php


namespace Infrastructure\Api\Rest\Client\Fee\Region;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Infrastructure\Api\Rest\Client\Fee\Region\Exception\RegionNotFoundException;
use Infrastructure\Api\Rest\Client\Fee\Region\Mapper\RegionMapperInterface;
use Wallet\Wallet\Fee\Region\Collection\RegionCollectionInterface;
use Wallet\Wallet\Fee\Region\Entity\RegionEntityInterface;

class RegionApiGuzzleHttpClient implements RegionApiClientInterface
{

    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var RegionMapperInterface
     */
    private $regionMapper;

    /**
     * RegionApiGuzzleHttpClient constructor.
     * @param Client $guzzleClient
     * @param RegionMapperInterface $regionMapper
     */
    public function __construct(
        Client $guzzleClient,
        RegionMapperInterface $regionMapper){
        $this->guzzleClient = $guzzleClient;
        $this->regionMapper = $regionMapper;
    }


    /**
     * @param array $regionCreatePayload
     * @return RegionEntityInterface
     */
    public function create(
        array $regionCreatePayload
    ): RegionEntityInterface
    {
        $response = $this->guzzleClient->post('/v1/regions', [
            RequestOptions::JSON => $regionCreatePayload
        ]);

        return $this
            ->regionMapper
            ->createRegionFromApiResponse(
                $response
            );
    }

    /**
     * @param string $regionId
     * @return RegionEntityInterface
     * @throws RegionNotFoundException
     */
    public function get(
        string $regionId
    ): RegionEntityInterface
    {
        try {
            $response = $this->guzzleClient->get(
                sprintf('/v1/regions/%s', $regionId)
            );
        } catch (ClientException $e) {
            if($e->getResponse()->getStatusCode() == 404){
                throw new RegionNotFoundException(
                    sprintf(' region %s not found', $regionId)
                );
            }

            throw $e;
        }

        return $this->regionMapper->createRegionFromApiResponse(
            $response
        );
    }


    /**
     * @param array $filters
     * @return RegionCollectionInterface
     */
    public function fetchAll(
        array $filters
    ): RegionCollectionInterface
    {
        try {
            $response = $this->guzzleClient->get('/v1/regions');
        } catch (ClientException $e) {
            throw $e;
        }

        return $this->regionMapper->createRegionCollectionFromApiResponse(
            $response
        );
    }
}
