<?php


namespace Wallet\Wallet\Event\Entity;


interface EventFilterEntityInterface
{

    /**
     * @param array $data
     * @return EventFilterEntityInterface
     */
    public static function fromArray(array $data): EventFilterEntityInterface;

    /**
     * @return array
     */
    public function toArray(): array;
}
