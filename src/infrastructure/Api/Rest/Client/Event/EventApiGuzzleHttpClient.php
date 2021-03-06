<?php


namespace Infrastructure\Api\Rest\Client\Event;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Infrastructure\Api\Rest\Client\Event\Mapper\EventMapperInterface;
use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;

class EventApiGuzzleHttpClient implements EventApiClientInterface
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var EventMapperInterface
     */
    private $eventMapper;

    /**
     * EventApiGuzzleHttpClient constructor.
     * @param Client $guzzleClient
     * @param EventMapperInterface $eventMapper
     */
    public function __construct(Client $guzzleClient, EventMapperInterface $eventMapper)
    {
        $this->guzzleClient = $guzzleClient;
        $this->eventMapper = $eventMapper;
    }

    /**
     * @inheritDoc
     */
    public function fetchAll(
        array $filter
    ): EventCollectionInterface{
        $response = $this->guzzleClient->post('/v1/events/search', [
            RequestOptions::JSON => $filter
        ]);

        return $this
            ->eventMapper
            ->createEventCollectionFromApiResponse(
                $response
            );
    }

    /**
     * @inheritDoc
     */
    public function create(array $eventPayload): EventEntityInterface
    {
        $response = $this->guzzleClient->post('/v1/events', [
            RequestOptions::JSON => $eventPayload
        ]);

        return $this
            ->eventMapper
            ->createEventFromApiResponse(
                $response
            );
    }


}
