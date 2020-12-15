<?php


namespace Wallet\Wallet\Fee\Region\Service;


use Wallet\Wallet\Fee\Region\Collection\RegionCollectionInterface;
use Wallet\Wallet\Fee\Region\Entity\RegionEntityInterface;
use Wallet\Wallet\Fee\Region\Repository\Exception\RegionNotFoundException;
use Wallet\Wallet\Fee\Region\Repository\RegionRepositoryInterface;

class RegionService implements RegionServiceInterface
{
    /**
     * @var RegionRepositoryInterface
     */
    private $regionRepository;

    /**
     * RegionService constructor.
     * @param RegionRepositoryInterface $regionRepository
     */
    public function __construct(
        RegionRepositoryInterface $regionRepository
    ){
        $this->regionRepository = $regionRepository;
    }


    /**
     * @param RegionEntityInterface $regionEntity
     * @return RegionEntityInterface
     */
    public function create(
        RegionEntityInterface $regionEntity
    ): RegionEntityInterface
    {
        return $this->regionRepository
            ->create($regionEntity);
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
        try{
            return $this->regionRepository->fetchWithRegionId(
                $regionId
            );
        }catch (RegionNotFoundException $e){
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
        return $this->regionRepository->fetchAll($filter);
    }
}
