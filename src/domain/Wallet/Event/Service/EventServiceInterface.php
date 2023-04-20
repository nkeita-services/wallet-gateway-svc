<?php


namespace Wallet\Wallet\Event\Service;


use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Entity\EventFilterEntityInterface;
use Wallet\Wallet\Event\Entity\EventPaginationEntityInterface;

interface EventServiceInterface
{

    /**
     * @param EventFilterEntityInterface $eventFilterEntity
     * @return EventPaginationEntityInterface
     */
    public function fetchWithCriteriaAndDateRange(
        EventFilterEntityInterface $eventFilterEntity
    ): EventPaginationEntityInterface;

    /**
     * @param EventEntityInterface $eventEntity
     * @return EventEntityInterface
     */
    public function create(
        EventEntityInterface $eventEntity
    ): EventEntityInterface;
}
