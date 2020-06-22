<?php


namespace Wallet\Wallet\Transfer\Entity;


interface TransferEntityInterface
{

    /**
     * @return float
     */
    public function getAmount(): float;

    /**
     * @return array
     */
    public function getSender(): array;
    /**
     * @return array
     */
    public function getReceiver(): array;

    /**
     * @param array $data
     * @return TransferEntityInterface
     */
    public static function  fromArray(
        array $data
    ): TransferEntityInterface;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return string
     */
    public function receiverAccountId(): string;

    /**
     * @return string
     */
    public function senderAccountId(): string;
}
