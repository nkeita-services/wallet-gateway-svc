<?php


namespace Wallet\Wallet\User\Beneficiary\Entity;


interface BeneficiaryEntityInterface
{
    /**
     * @return array
     */
    public function toArray(): array ;

    /**
     * @param array $data
     * @return BeneficiaryEntityInterface
     */
    public static function fromArray(
        array $data
    ):BeneficiaryEntityInterface;

}
