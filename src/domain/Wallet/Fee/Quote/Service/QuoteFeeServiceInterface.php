<?php


namespace Wallet\Wallet\Fee\Quote\Service;


use Wallet\Wallet\Fee\Quote\Entity\QuoteFeeEntityInterface;
use Wallet\Wallet\Fee\Transaction\TransactionEntityInterface;

interface QuoteFeeServiceInterface
{
    /**
     * @param TransactionEntityInterface $transactionEntity
     * @return QuoteFeeEntityInterface
     */
    public function getQuote(
        TransactionEntityInterface $transactionEntity
    ) : QuoteFeeEntityInterface;

    /**
     * @param TransactionEntityInterface $transactionEntity
     * @return QuoteFeeEntityInterface
     */
    public function getQuotes(
        TransactionEntityInterface $transactionEntity
    ) : QuoteFeeEntityInterface;
}
