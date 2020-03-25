<?php


namespace Wallet\Wallet\Event\Repository;


use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;

interface EventRepositoryInterface
{

    /**
     * @param array $criteria
     * @return EventCollectionInterface
     */
    public function fetchAllWithCriteria(
        array $criteria
    ):EventCollectionInterface;

    /**
     * @param EventEntityInterface $eventEntity
     * @return EventEntityInterface
     */
    public function create(
        EventEntityInterface $eventEntity
    ):EventEntityInterface;
}
