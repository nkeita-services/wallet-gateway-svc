<?php


namespace Wallet\Wallet\Account\Service;

use DateTimeInterface;
use Wallet\Wallet\Account\Entity\TransactionEntity;
use Wallet\Wallet\Event\Entity\EventEntityInterface;
use Wallet\Wallet\Event\Entity\EventFilterEntityInterface;
use Wallet\Wallet\Event\Entity\EventPaginationEntityInterface;

interface AccountTransactionServiceInterface
{

    /**
     * @param EventFilterEntityInterface $eventFilterEntity
     * @return mixed
     */
    public function fetchWithAccountIdAndDateRange(
       /* string $accountId,
        ?string $type,
        DateTimeInterface $fromDate,
        DateTimeInterface $toDate*/

        EventFilterEntityInterface $eventFilterEntity
    ) :  EventPaginationEntityInterface;

    /**
     * @param TransactionEntity $transactionEntity
     * @return EventEntityInterface
     */
    public function create(
        TransactionEntity $transactionEntity
    ): EventEntityInterface;
}
