<?php


namespace Infrastructure\Api\Rest\Client\Event\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Event\Collection\EventCollection;
use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntity;
use Wallet\Wallet\Event\Entity\EventEntityInterface;

class EventMapper implements EventMapperInterface
{

    /**
     * @inheritDoc
     */
    public function createEventCollectionFromApiResponse(
        ResponseInterface $response
    ): EventCollectionInterface
    {
        $eventData = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return EventCollection::fromArray(
            $eventData['data']['WalletEvents']
        );
    }

    /**
     * @inheritDoc
     */
    public function createEventFromApiResponse(
        ResponseInterface $response
    ): EventEntityInterface{
        $eventData = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return EventEntity::fromArray(
            $eventData['data']['WalletEvent']
        );
    }


}
