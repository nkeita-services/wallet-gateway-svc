<?php


namespace Wallet\Wallet\Fee\Region\Service;


use Wallet\Wallet\Fee\Region\Collection\RegionCollectionInterface;
use Wallet\Wallet\Fee\Region\Entity\RegionEntityInterface;
use Wallet\Wallet\Fee\Region\Repository\Exception\RegionNotFoundException;

interface RegionServiceInterface
{
    /**
     * @param RegionEntityInterface $regionEntity
     * @return RegionEntityInterface
     */
    public function create(
        RegionEntityInterface $regionEntity
    ): RegionEntityInterface;

    /**
     * @param string $regionId
     * @return RegionEntityInterface
     * @throws RegionNotFoundException
     */
    public function fetchWithRegionId(
        string $regionId
    ): RegionEntityInterface;

    /**
     * @param array $filter
     * @return RegionCollectionInterface
     */
    public function fetchAll(
        array $filter
    ): RegionCollectionInterface;
}
