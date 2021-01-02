<?php


namespace Wallet\Wallet\Fee\Quote\Repository;


use Wallet\Wallet\Fee\Quote\Entity\QuoteFeeEntityInterface;
use Wallet\Wallet\Fee\Transaction\TransactionEntityInterface;

interface QuoteFeeRepositoryInterface
{
    /**
     * @param TransactionEntityInterface $transactionEntity
     * @return QuoteFeeEntityInterface
     */
    public function getQuote(
        TransactionEntityInterface $transactionEntity
    ) : QuoteFeeEntityInterface;
}
