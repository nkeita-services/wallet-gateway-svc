<?php


namespace Wallet\Wallet\User\Collection;


use Wallet\Wallet\Plan\Collection\PlanCollectionInterface;

interface UserCollectionInterface
{
    /**
     * @param array $users
     * @return UserCollectionInterface
     */
    public static function fromArray(array $users):UserCollectionInterface;

    /**
     * @return array
     */
    public function toArray(): array ;
}
