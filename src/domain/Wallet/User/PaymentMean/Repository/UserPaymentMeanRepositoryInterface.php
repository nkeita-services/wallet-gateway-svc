<?php


namespace Wallet\Wallet\User\PaymentMean\Repository;


use Wallet\Wallet\User\PaymentMean\Collection\PaymentMeanCollectionInterface;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntityInterface;

interface UserPaymentMeanRepositoryInterface
{
    /**
     * @param PaymentMeanEntityInterface $paymentMeanEntity
     * @param string $userId
     * @return PaymentMeanEntityInterface
     */
    public function create(
        PaymentMeanEntityInterface $paymentMeanEntity,
        string $userId
    ): PaymentMeanEntityInterface;

    /**
     * @param string $paymentMeanId
     * @param string $userId
     * @return PaymentMeanEntityInterface
     */
    public function fetch(
        string $paymentMeanId,
        string $userId
    ): PaymentMeanEntityInterface;

    /**
     * @param $filter
     * @param string $userId
     * @return PaymentMeanCollectionInterface
     */
    public function fetchAll(
        $filter,
        string $userId
    ): PaymentMeanCollectionInterface;
}
