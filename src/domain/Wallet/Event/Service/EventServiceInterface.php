<?php


namespace Wallet\Wallet\Event\Service;


use Wallet\Wallet\Event\Collection\EventCollectionInterface;

interface EventServiceInterface
{

    /**
     * @param array $criteria
     * @param int|null $fromTimestamp
     * @param int|null $toTimestamp
     * @param int|null $limit
     * @return EventCollectionInterface
     */
    public function fetchWithCriteriaAndDateRange(
        array $criteria,
        ?int $fromTimestamp = null,
        ?int $toTimestamp = null,
        ?int $limit = null
    ): EventCollectionInterface;
}
