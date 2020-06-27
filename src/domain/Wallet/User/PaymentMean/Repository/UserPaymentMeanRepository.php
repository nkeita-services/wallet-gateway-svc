<?php


namespace Wallet\Wallet\User\PaymentMean\Repository;


use Infrastructure\Api\Rest\Client\User\PaymentMean\UserPaymentMeanApiClientInterface;
use Wallet\Wallet\User\PaymentMean\Collection\PaymentMeanCollectionInterface;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntityInterface;

class UserPaymentMeanRepository implements UserPaymentMeanRepositoryInterface
{

    /**
     * @var UserPaymentMeanApiClientInterface
     */
    private $userPaymentMeanApiClient;

    /**
     * UserPaymentMeanRepository constructor.
     * @param UserPaymentMeanApiClientInterface $userPaymentMeanApiClient
     */
    public function __construct(UserPaymentMeanApiClientInterface $userPaymentMeanApiClient)
    {
        $this->userPaymentMeanApiClient = $userPaymentMeanApiClient;
    }


    /**
     * @inheritDoc
     */
    public function create(
        PaymentMeanEntityInterface $paymentMeanEntity,
        string $userId): PaymentMeanEntityInterface
    {
        return $this
            ->userPaymentMeanApiClient
            ->create(
                $paymentMeanEntity->toArray(),
                $userId
            );
    }

    /**
     * @inheritDoc
     */
    public function fetch(
        string $paymentMeanId,
        string $userId
    ): PaymentMeanEntityInterface{

        return $this
            ->userPaymentMeanApiClient
            ->get(
                $paymentMeanId,
                $userId
            );
    }

    /**
     * @inheritDoc
     */
    public function fetchAll(
        $filter,
        string $userId): PaymentMeanCollectionInterface{
        return $this
            ->userPaymentMeanApiClient
            ->fetchAll(
                $filter,
                $userId
            );
    }
}
