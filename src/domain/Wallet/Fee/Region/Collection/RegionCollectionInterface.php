<?php


namespace Wallet\Wallet\Fee\Region\Collection;


interface RegionCollectionInterface
{
    /**
     * @param array $data
     * @return RegionCollectionInterface
     */
    public static function fromArray(array $data):RegionCollectionInterface;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return array
     */
    public function getCollection(): array;
}
