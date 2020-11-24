<?php


namespace Wallet\Wallet\Account\Entity;


interface TransactionEntityInterface
{

    const TRANSACTION_TYPE_CREDIT = 'Credit';

    const TRANSACTION_TYPE_DEBIT = 'Debit';

    /**
     * @return string
     */
    public function getUserId(): ?string;

    /**
     * @return string
     */
    public function getAccountId(): string;

    /**
     * @return string
     */
    public function getAmount(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

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
    public function getTransactionType(): string;

}
