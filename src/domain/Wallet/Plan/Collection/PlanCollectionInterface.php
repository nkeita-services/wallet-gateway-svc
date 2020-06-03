<?php


namespace Wallet\Wallet\Plan\Collection;


use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

interface PlanCollectionInterface
{
    /**
     * @param array $plans
     * @return PlanCollectionInterface
     */
    public static function fromArray(array $plans):PlanCollectionInterface;

    /**
     * @return array
     */
    public function toArray(): array ;
}
