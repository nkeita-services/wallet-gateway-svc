<?php


namespace Wallet\Wallet\Plan\Collection;


use Wallet\Wallet\Plan\Entity\WalletPlanEntity;
use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

class PlanCollection implements PlanCollectionInterface
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
    public static function fromArray(array $plans): PlanCollectionInterface
    {
        return new static(
            array_map(function (array $plan){
                return WalletPlanEntity::fromArray($plan);
            },$plans)
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_map(function (WalletPlanEntityInterface $walletPlanEntity){
            return $walletPlanEntity->toArray();
        },$this->entities);
    }
}
