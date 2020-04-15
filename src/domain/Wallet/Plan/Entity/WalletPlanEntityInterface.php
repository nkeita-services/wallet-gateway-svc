<?php


namespace Wallet\Wallet\Plan\Entity;


interface WalletPlanEntityInterface
{
    /**
     * @param array $data
     * @return WalletPlanEntityInterface
     */
    public static function fromArray(
        array $data
    ):WalletPlanEntityInterface;

    /**
     * @return array
     */
    public function toArray():array;
}
