<?php


namespace Infrastructure\Api\Rest\Client\Fee\Region\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Fee\Region\Collection\RegionCollectionInterface;
use Wallet\Wallet\Fee\Region\Entity\RegionEntityInterface;

interface RegionMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return RegionEntityInterface
     */
    public function createRegionFromApiResponse(
        ResponseInterface $response
    ):RegionEntityInterface;

    /**
     * @param ResponseInterface $response
     * @return RegionCollectionInterface
     */
    public function createRegionCollectionFromApiResponse(
        ResponseInterface $response
    ): RegionCollectionInterface;
}
