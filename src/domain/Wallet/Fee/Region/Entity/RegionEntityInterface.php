<?php


namespace Wallet\Wallet\Fee\Region\Entity;


interface RegionEntityInterface
{
    /**
     * @param array $data
     * @return RegionEntityInterface
     */
    public static function fromArray(
        array $data
    ):RegionEntityInterface;

    /**
     * @return array
     */
    public function toArray():array;
}
