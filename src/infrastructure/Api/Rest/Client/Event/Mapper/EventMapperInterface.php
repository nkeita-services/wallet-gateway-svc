<?php


namespace Infrastructure\Api\Rest\Client\Event\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Event\Collection\EventCollectionInterface;

interface EventMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return EventCollectionInterface
     */
    public function createEventCollectionFromApiResponse(
        ResponseInterface $response
    ):EventCollectionInterface;
}
