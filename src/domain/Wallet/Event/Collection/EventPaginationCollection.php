<?php


namespace Wallet\Wallet\Event\Collection;


use Wallet\Wallet\Event\Entity\EventEntity;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Entity\EventPaginationEntity;
use Wallet\Wallet\Event\Entity\EventPaginationEntityInterface;

class EventPaginationCollection implements EventPaginationCollectionInterface
{

    /**
     * @var array
     */
    private $collection;

    /**
     * EventCollection constructor.
     * @param array $collection
     */
    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $data): EventPaginationCollectionInterface
    {
        return new static(
            array_map(function (array $event) {
                return EventPaginationEntity::fromArray($event);
            }, $data)
        );
    }


    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_map(function (EventPaginationEntityInterface $eventPaginationEntity){
            return $eventPaginationEntity->toArray();
        },$this->collection);
    }
}
