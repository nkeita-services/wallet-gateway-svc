<?php


namespace Wallet\Wallet\Fee\Fee\Collection;


interface FeeCollectionInterface
{
    /**
     * @param array $data
     * @return FeeCollectionInterface
     */
    public static function fromArray(array $data):FeeCollectionInterface;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return array
     */
    public function getCollection(): array;
}
