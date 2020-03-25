<?php


namespace Wallet\Wallet\Event\Repository;


use Infrastructure\Api\Rest\Client\Event\EventApiClientInterface;
use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;

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

    /**
     * @inheritDoc
     */
    public function create(
        EventEntityInterface $eventEntity
    ): EventEntityInterface{
        return $this
            ->eventApiClient
            ->create(
                [
                    'originator' => $eventEntity->getOriginator(),
                    'originatorId'=> $eventEntity->getOriginatorId(),
                    'actions'=>$eventEntity->getActions(),
                    'description'=>$eventEntity->getDescription(),
                    'timestamp'=>$eventEntity->getTimestamp(),
                    'data'=>$eventEntity->getData()
                ]
            );
    }


}
