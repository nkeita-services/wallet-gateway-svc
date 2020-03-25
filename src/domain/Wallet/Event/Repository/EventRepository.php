<?php


namespace Wallet\Wallet\Event\Repository;


use Infrastructure\Api\Rest\Client\Event\EventApiClientInterface;
use Wallet\Wallet\Event\Collection\EventCollectionInterface;

class EventRepository implements EventRepositoryInterface
{
    /**
     * @var EventApiClientInterface
     */
    private $eventApiClient;

    /**
     * EventRepository constructor.
     * @param EventApiClientInterface $eventApiClient
     */
    public function __construct(EventApiClientInterface $eventApiClient)
    {
        $this->eventApiClient = $eventApiClient;
    }


    /**
     * @inheritDoc
     */
    public function fetchAllWithCriteria(
        array $criteria
    ): EventCollectionInterface
    {
        return $this
            ->eventApiClient
            ->fetchAll(
                $criteria
            );
    }
}
