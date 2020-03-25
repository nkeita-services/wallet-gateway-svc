<?php


namespace Infrastructure\Api\Rest\Client\Event\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Event\Collection\EventCollection;
use Wallet\Wallet\Event\Collection\EventCollectionInterface;

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
}
