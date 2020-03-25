<?php


namespace Infrastructure\Api\Rest\Client\Event;


use Wallet\Wallet\Event\Collection\EventCollectionInterface;

interface EventApiClientInterface
{

    /**
     * @param array $filter
     * @return EventCollectionInterface
     */
    public function fetchAll(
        array $filter
    ):EventCollectionInterface;
}
