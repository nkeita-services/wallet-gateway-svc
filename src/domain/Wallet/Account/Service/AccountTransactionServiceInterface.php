<?php


namespace Wallet\Wallet\Account\Service;

use DateTimeInterface;
use Wallet\Wallet\Account\Entity\TransactionEntity;
use Wallet\Wallet\Event\Entity\EventEntityInterface;

interface AccountTransactionServiceInterface
{

    /**
     * @param string $accountId
     * @param string|null $type
     * @param DateTimeInterface $fromDate
     * @param DateTimeInterface $toDate
     * @return mixed
     */
    public function fetchWithAccountIdAndDateRange(
        string $accountId,
        ?string $type,
        DateTimeInterface $fromDate,
        DateTimeInterface $toDate
    );

    /**
     * @param TransactionEntity $transactionEntity
     * @return EventEntityInterface
     */
    public function create(
        TransactionEntity $transactionEntity
    ): EventEntityInterface;
}
