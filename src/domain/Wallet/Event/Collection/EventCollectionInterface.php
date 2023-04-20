<?php


namespace Wallet\Wallet\Event\Collection;


interface EventCollectionInterface
{

    /**
     * @param array $data
     * @return EventCollectionInterface
     */
    public static function fromArray(array $data): EventCollectionInterface;

    /**
     * @return array
     */
    public function toArray(): array;

}
