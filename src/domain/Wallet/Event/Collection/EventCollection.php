<?php


namespace Wallet\Wallet\Event\Collection;


use Wallet\Account\Entity\AccountEntityInterface;
use Wallet\Wallet\Event\Entity\EventEntity;
use Wallet\Wallet\Event\Entity\EventEntityInterface;

class EventCollection implements EventCollectionInterface
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
    public static function fromArray(array $data): EventCollectionInterface
    {
        return new static(
            array_map(function (array $event) {
                return EventEntity::fromArray($event);
            }, $data)
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_map(function (EventEntityInterface $eventEntity){
            return $eventEntity->toArray();
        },$this->collection);
    }


}
