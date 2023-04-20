<?php


namespace Wallet\Wallet\Event\Entity;


interface EventPaginationEntityInterface
{
    /**
     * @param array $data
     * @return EventPaginationEntityInterface
     */
    public static function fromArray(array $data): EventPaginationEntityInterface;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return int
     */
    public function getPage(): int;

    /**
     * @return int
     */
    public function getLimit(): int;

    /**
     * @return int
     */
    public function getTotal(): int;

    /**
     * @return array
     */
    public function getWalletAccountTransactions(): array;

    /**
     * @param array $walletAccountTransactions
     * @return EventPaginationEntityInterface
     */
    public function setWalletAccountTransactions(
        array $walletAccountTransactions
    ): EventPaginationEntityInterface;
}
