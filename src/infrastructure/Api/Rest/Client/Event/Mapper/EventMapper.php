<?php


namespace Infrastructure\Api\Rest\Client\Event\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Event\Collection\EventCollection;
use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Collection\EventPaginationCollection;
use Wallet\Wallet\Event\Entity\EventEntity;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Entity\EventPaginationEntity;
use Wallet\Wallet\Event\Entity\EventPaginationEntityInterface;

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
     * @param ResponseInterface $response
     * @return EventPaginationEntityInterface
     */
    public function createEventPaginationCollectionFromApiResponse(
        ResponseInterface $response
    ):EventPaginationEntityInterface {
        $eventData = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return EventPaginationEntity::fromArray(
            [
                'total' => $eventData['data']['total_number'],
                'page' => $eventData['data']['page'],
                'limit' => $eventData['data']['limit'],
                'walletAccountTransactions' => $eventData['data']['WalletEvents']
            ]
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
