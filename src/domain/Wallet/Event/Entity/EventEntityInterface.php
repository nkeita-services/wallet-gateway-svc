<?php


namespace Wallet\Wallet\Event\Entity;


interface EventEntityInterface
{

    /**
     * @param array $data
     * @return EventEntityInterface
     */
    public static function fromArray(array $data): EventEntityInterface;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return string
     */
    public function getEventId(): string;

    /**
     * @return string
     */
    public function getOriginator(): string;

    /**
     * @return string
     */
    public function getOriginatorId(): string;

    /**
     * @return string
     */
    public function getTimestamp(): string;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return array
     */
    public function getActions(): array;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getEntityId(): string;

    /**
     * @return string
     */
    public function getEntity(): string;


}
