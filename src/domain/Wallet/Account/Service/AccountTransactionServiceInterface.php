<?php


namespace Wallet\Wallet\Account\Service;

use DateTimeInterface;
use Wallet\Wallet\Event\Entity\EventEntityInterface;

interface AccountTransactionServiceInterface
{

    /**
     * @param string $accountId
     * @param DateTimeInterface $fromDate
     * @param DateTimeInterface $toDate
     * @return mixed
     */
    public function fetchWithAccountIdAndDateRange(
        string $accountId,
        DateTimeInterface $fromDate,
        DateTimeInterface $toDate
    );

    /**
     * @param string $userId
     * @param string $accountId
     * @param string $amount
     * @param string $originator
     * @param string $originatorId
     * @return EventEntityInterface
     */
    public function create(
        string $userId,
        string $accountId,
        string $amount,
        string $originator,
        string $originatorId
    ): EventEntityInterface;
}
