<?php


namespace Wallet\Wallet\Account\Service;

use DateTimeInterface;

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
}
