<?php


namespace Wallet\Wallet\Event\Repository;


use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Entity\EventFilterEntityInterface;
use Wallet\Wallet\Event\Entity\EventPaginationEntityInterface;

interface EventRepositoryInterface
{

    /**
     * @param EventFilterEntityInterface $eventFilterEntity
     * @return EventPaginationEntityInterface
     */
    public function fetchAllWithCriteria(
        EventFilterEntityInterface $eventFilterEntity
    ):EventPaginationEntityInterface;

    /**
     * @param EventEntityInterface $eventEntity
     * @return EventEntityInterface
     */
    public function create(
        EventEntityInterface $eventEntity
    ):EventEntityInterface;
}
