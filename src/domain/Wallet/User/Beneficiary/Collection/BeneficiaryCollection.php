<?php


namespace Wallet\Wallet\User\Beneficiary\Collection;


use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntity;

class BeneficiaryCollection implements BeneficiaryCollectionInterface
{

    private $entities;

    /**
     * PlanCollection constructor.
     * @param $entities
     */
    public function __construct($entities)
    {
        $this->entities = $entities;
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $beneficiaries): BeneficiaryCollectionInterface
    {
        return new static(
            array_map(function (array $beneficiary){
                return BeneficiaryEntity::fromArray($beneficiary);
            },$beneficiaries)
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_map(function (BeneficiaryEntity $beneficiaryEntity){
            return $beneficiaryEntity->toArray();
        },$this->entities);
    }
}
