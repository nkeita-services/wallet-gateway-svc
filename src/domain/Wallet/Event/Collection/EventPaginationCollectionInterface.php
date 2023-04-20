<?php


namespace Wallet\Wallet\Event\Collection;


interface EventPaginationCollectionInterface
{
    /**
     * @param array $data
     * @return EventPaginationCollectionInterface
     */
    public static function fromArray(array $data): EventPaginationCollectionInterface;

    /**
     * @return array
     */
    public function toArray(): array;
}
