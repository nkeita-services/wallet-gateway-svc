<?php


namespace Infrastructure\Api\Rest\Client\Event;


use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Entity\EventFilterEntityInterface;
use Wallet\Wallet\Event\Entity\EventPaginationEntityInterface;

interface EventApiClientInterface
{

    /**
     * @param EventFilterEntityInterface $eventFilterEntity
     * @return EventPaginationEntityInterface
     */
    public function fetchAll(
        EventFilterEntityInterface $eventFilterEntity
    ):EventPaginationEntityInterface;

    /**
     * @param array $eventPayload
     * @return EventEntityInterface
     */
    public function create(
        array $eventPayload
    ): EventEntityInterface;
}
