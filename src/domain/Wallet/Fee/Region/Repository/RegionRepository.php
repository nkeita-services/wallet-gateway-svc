<?php


namespace Wallet\Wallet\Fee\Region\Repository;


use Infrastructure\Api\Rest\Client\Fee\Region\RegionApiClientInterface;
use Wallet\Wallet\Fee\Region\Collection\RegionCollectionInterface;
use Wallet\Wallet\Fee\Region\Entity\RegionEntityInterface;
use Wallet\Wallet\Fee\Region\Repository\Exception\RegionNotFoundException;

class RegionRepository implements RegionRepositoryInterface
{

    /**
     * @var RegionApiClientInterface
     */
    private $regionApiClient;

    /**
     * RegionRepository constructor.
     * @param RegionApiClientInterface $regionApiClient
     */
    public function __construct(
        RegionApiClientInterface $regionApiClient
    ){
        $this->regionApiClient = $regionApiClient;
    }

    /**
     * @param RegionEntityInterface $regionEntity
     * @return RegionEntityInterface
     */
    public function create(
        RegionEntityInterface $regionEntity
    ): RegionEntityInterface
    {
        return $this
            ->regionApiClient
            ->create(
                $regionEntity->toArray()
            );
    }

    /**
     * @param string $regionId
     * @return RegionEntityInterface
     * @throws RegionNotFoundException
     */
    public function fetchWithRegionId(
        string $regionId
    ): RegionEntityInterface
    {
        try {
            return $this
                ->regionApiClient
                ->get(
                    $regionId
                );
        } catch (RegionNotFoundException $e) {
            throw new RegionNotFoundException(
                $e->getMessage()
            );
        }
    }

    /**
     * @param array $filter
     * @return RegionCollectionInterface
     */
    public function fetchAll(
        array $filter
    ): RegionCollectionInterface
    {
        return $this
            ->regionApiClient
            ->fetchAll($filter);
    }
}
