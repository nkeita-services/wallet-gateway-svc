<?php


namespace Wallet\Wallet\User\PaymentMean\Service;


use Wallet\Wallet\User\PaymentMean\Collection\PaymentMeanCollectionInterface;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntityInterface;
use Wallet\Wallet\User\PaymentMean\Repository\UserPaymentMeanRepositoryInterface;

class UserPaymentMeanService implements UserPaymentMeanServiceInterface
{

    /**
     * @var UserPaymentMeanRepositoryInterface
     */
    private $userPaymentMeanRepository;

    /**
     * UserPaymentMeanService constructor.
     * @param UserPaymentMeanRepositoryInterface $userPaymentMeanRepository
     */
    public function __construct(UserPaymentMeanRepositoryInterface $userPaymentMeanRepository)
    {
        $this->userPaymentMeanRepository = $userPaymentMeanRepository;
    }


    /**
     * @inheritDoc
     */
    public function create(
        PaymentMeanEntityInterface $paymentMeanEntity,
        string $userId): PaymentMeanEntityInterface
    {
        return $this
            ->userPaymentMeanRepository
            ->create(
                $paymentMeanEntity,
                $userId
            );
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $paymentMeanId, string $userId): PaymentMeanEntityInterface
    {
       return $this
           ->userPaymentMeanRepository
           ->fetch(
               $paymentMeanId,
               $userId
           );
    }

    /**
     * @inheritDoc
     */
    public function fetchAll($filter, string $userId): PaymentMeanCollectionInterface
    {
        return $this
            ->userPaymentMeanRepository
            ->fetchAll(
                $filter,
                $userId
            );
    }
}
