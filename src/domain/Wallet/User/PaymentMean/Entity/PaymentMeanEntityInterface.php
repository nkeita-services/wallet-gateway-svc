<?php


namespace Wallet\Wallet\User\PaymentMean\Entity;


interface PaymentMeanEntityInterface
{

    /**
     * @return array
     */
    public function toArray(): array ;

    /**
     * @param array $data
     * @return PaymentMeanEntityInterface
     */
    public static function fromArray(
        array $data
    ):PaymentMeanEntityInterface;

}
