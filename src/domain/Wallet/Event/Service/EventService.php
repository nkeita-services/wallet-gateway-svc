<?php


namespace Wallet\Wallet\Event\Service;


use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Repository\EventRepositoryInterface;

class EventService implements EventServiceInterface
{
    /**
     * @var EventRepositoryInterface
     */
    private $eventRepository;

    /**
     * EventService constructor.
     * @param EventRepositoryInterface $eventRepository
     */
    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }


    /**
     * @inheritDoc
     */
    public function fetchWithCriteriaAndDateRange(
        array $criteria,
        ?int $fromTimestamp = null,
        ?int $toTimestamp = null,
        ?int $limit = null): EventCollectionInterface{
        return $this
            ->eventRepository
            ->fetchAllWithCriteria(
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
            ->eventRepository
            ->create(
                $eventEntity
            );
    }


}
