<?php


namespace Wallet\Wallet\Organization\Collection;


use Wallet\Account\Entity\AccountEntity;
use Wallet\Wallet\Organization\Entity\OrganizationEntity;
use Wallet\Wallet\Organization\Entity\OrganizationEntityInterface;

class OrganizationCollection implements OrganizationCollectionInterface
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
     * @inheritDoc
     */
    public static function fromArray(array $data): OrganizationCollectionInterface
    {
        return new static(
            array_map(function (array $organization){
                return OrganizationEntity::fromArray($organization);
            },$data)
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_map(function (OrganizationEntityInterface $organizationEntity){
            return $organizationEntity->toArray();
        },$this->collection);
    }
}
