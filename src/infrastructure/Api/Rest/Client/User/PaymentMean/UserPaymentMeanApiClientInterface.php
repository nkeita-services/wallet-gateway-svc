<?php


namespace Infrastructure\Api\Rest\Client\User\PaymentMean;


use Wallet\Wallet\User\PaymentMean\Collection\PaymentMeanCollectionInterface;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntityInterface;

interface UserPaymentMeanApiClientInterface
{
    /**
     * @param array $paymentMeanPayload
     * @param string $userId
     * @return PaymentMeanEntityInterface
     */
    public function create(
        array $paymentMeanPayload,
        string $userId
    ): PaymentMeanEntityInterface;

    /**
     * @param string $paymentMeanId
     * @param string $userId
     * @return PaymentMeanEntityInterface
     */
    public function get(
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
