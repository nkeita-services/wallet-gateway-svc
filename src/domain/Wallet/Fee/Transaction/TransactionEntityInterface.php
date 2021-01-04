<?php


namespace Wallet\Wallet\Fee\Transaction;


interface TransactionEntityInterface
{

    /**
     * @param array $data
     * @return TransactionEntityInterface
     */
    public static function fromArray(array $data): TransactionEntityInterface;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return string
     */
    public function getPaymentMean(): string;

    /**
     * @param string $paymentMean
     * @return TransactionEntityInterface
     */
    public function setPaymentMean(string $paymentMean): TransactionEntityInterface;

    /**
     * @return array
     */
    public function getWalletOrganizations(): array ;

    /**
     * @return array
     */
    public function getRegions(): array ;

    /**
     * @return string
     */
    public function getCurrency(): string;

    /**
     * @return string
     */
    public function getAccountId(): string;

    /**
     * @return float
     */
    public function getAmount(): float;

    /**
     * @return string
     */
    public function getOperation(): string;

    /**
     * @return string
     */
    public function getOriginator(): string;

}
