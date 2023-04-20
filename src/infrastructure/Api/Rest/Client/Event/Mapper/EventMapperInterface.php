<?php


namespace Infrastructure\Api\Rest\Client\Event\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Entity\EventPaginationEntityInterface;

interface EventMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return EventCollectionInterface
     */
    public function createEventCollectionFromApiResponse(
        ResponseInterface $response
    ):EventCollectionInterface;

    /**
     * @param ResponseInterface $response
     * @return EventPaginationEntityInterface
     */
    public function createEventPaginationCollectionFromApiResponse(
        ResponseInterface $response
    ):EventPaginationEntityInterface;

    /**
     * @param ResponseInterface $response
     * @return EventEntityInterface
     */
    public function createEventFromApiResponse(
        ResponseInterface $response
    ):EventEntityInterface;
}
