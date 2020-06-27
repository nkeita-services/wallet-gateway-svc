<?php


namespace Wallet\Wallet\User\PaymentMean\Collection;


use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntity;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntity;

class PaymentMeanCollection implements PaymentMeanCollectionInterface
{

    private $entities;

    /**
     * PlanCollection constructor.
     * @param $entities
     */
    public function __construct($entities)
    {
        $this->entities = $entities;
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $paymentMeans): PaymentMeanCollectionInterface
    {
        return new static(
            array_map(function (array $paymentMean){
                return PaymentMeanEntity::fromArray($paymentMean);
            },$paymentMeans)
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_map(function (PaymentMeanEntity $paymentMeanEntity){
            return $paymentMeanEntity->toArray();
        },$this->entities);
    }
}
