<?php


namespace Wallet\Wallet\Fee\Fee\Collection;


use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntity;


class FeeCollection implements FeeCollectionInterface
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
     * @return FeeCollectionInterface
     */
    public static function fromArray(array $data):FeeCollectionInterface
    {
        return new static(
            array_map(function (array $organization){
                return FeeEntity::fromArray($organization);
            },$data)
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function (FeeEntityInterface $organizationEntity){
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
