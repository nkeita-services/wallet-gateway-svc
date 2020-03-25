<?php


namespace Infrastructure\Api\Rest\Client\Event;


use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;

interface EventApiClientInterface
{

    /**
     * @param array $filter
     * @return EventCollectionInterface
     */
    public function fetchAll(
        array $filter
    ):EventCollectionInterface;

    /**
     * @param array $eventPayload
     * @return EventEntityInterface
     */
    public function create(
        array $eventPayload
    ): EventEntityInterface;
}
