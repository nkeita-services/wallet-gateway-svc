<?php


namespace Wallet\Wallet\Event\Repository;


use Wallet\Wallet\Event\Collection\EventCollectionInterface;

interface EventRepositoryInterface
{

    /**
     * @param array $criteria
     * @return EventCollectionInterface
     */
    public function fetchAllWithCriteria(
        array $criteria
    ):EventCollectionInterface;
}
