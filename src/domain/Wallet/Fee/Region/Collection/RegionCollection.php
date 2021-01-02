<?php


namespace Wallet\Wallet\Fee\Region\Collection;


use Wallet\Wallet\Fee\Region\Entity\RegionEntity;
use Wallet\Wallet\Fee\Region\Entity\RegionEntityInterface;

class RegionCollection implements RegionCollectionInterface
{
    /**
     * @var array
     */
    private $collection;

    /**
     * OrganizationCollection constructor.
     * @param array $collection
     */
    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param array $data
     * @return RegionCollectionInterface
     */
    public static function fromArray(array $data):RegionCollectionInterface
    {
        return new static(
            array_map(function (array $organization){
                return RegionEntity::fromArray($organization);
            },$data)
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function (RegionEntityInterface $organizationEntity){
            return $organizationEntity->toArray();
        },$this->collection);
    }

    /**
     * @return array
     */
    public function getCollection(): array
    {
        return $this->collection;
    }

}
