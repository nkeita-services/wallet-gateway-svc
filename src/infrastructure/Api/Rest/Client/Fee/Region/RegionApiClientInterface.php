<?php


namespace Infrastructure\Api\Rest\Client\Fee\Region;


use Infrastructure\Api\Rest\Client\Fee\Region\Exception\RegionNotFoundException;
use Wallet\Wallet\Fee\Region\Collection\RegionCollectionInterface;
use Wallet\Wallet\Fee\Region\Entity\RegionEntityInterface;

interface RegionApiClientInterface
{

    /**
     * @param array $regionCreatePayload
     * @return RegionEntityInterface
     */
    public function create(
        array $regionCreatePayload
    ): RegionEntityInterface;

    /**
     * @param string $regionId
     * @return RegionEntityInterface
     * @throws RegionNotFoundException
     */
    public function get(
        string $regionId
    ): RegionEntityInterface;


    /**
     * @param array $filters
     * @return RegionCollectionInterface
     */
    public function fetchAll(
        array $filters
    ): RegionCollectionInterface;
}
