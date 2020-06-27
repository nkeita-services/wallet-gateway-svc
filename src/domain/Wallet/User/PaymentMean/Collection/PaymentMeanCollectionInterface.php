<?php


namespace Wallet\Wallet\User\PaymentMean\Collection;


interface PaymentMeanCollectionInterface
{
    /**
     * @param array $paymentMeans
     * @return PaymentMeanCollectionInterface
     */
    public static function fromArray(array $paymentMeans):PaymentMeanCollectionInterface;

    /**
     * @return array
     */
    public function toArray(): array ;
}
