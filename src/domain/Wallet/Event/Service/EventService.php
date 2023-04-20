<?php


namespace Wallet\Wallet\Event\Service;


use Wallet\Wallet\Event\Collection\EventCollectionInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Entity\EventFilterEntityInterface;
use Wallet\Wallet\Event\Entity\EventPaginationEntityInterface;
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
        EventFilterEntityInterface $eventFilterEntity
    ): EventPaginationEntityInterface {
        return $this
            ->eventRepository
            ->fetchAllWithCriteria(
                $eventFilterEntity
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
