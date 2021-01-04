<?php


namespace Wallet\Wallet\Fee\Fee\Entity;


interface FeeEntityInterface
{
    /**
     * @param array $data
     * @return FeeEntityInterface
     */
    public static function fromArray(array $data): FeeEntityInterface;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return string
     */
    public function getFeeId(): string;

    /**
     * @return string
     */
    public function getPaymentMean(): string;

    /**
     * @return array
     */
    public function getWalletOrganizations(): array;

    /**
     * @return array
     */
    public function getRegions(): array;


    /**
     * @return SpecEntityInterface
     */
    public function getFees(): SpecEntityInterface;
}
