<?php


namespace Wallet\Wallet\Fee\Fee\Entity;


interface SpecEntityInterface
{

    /**
     * @param array $data
     * @return SpecEntityInterface
     */
    public static function fromArray(array $data): SpecEntityInterface;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return float
     */
    public function getRate(): float;

    /**
     * @return float
     */
    public function getFlatRate(): float;
}
