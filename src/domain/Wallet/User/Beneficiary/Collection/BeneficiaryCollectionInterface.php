<?php


namespace Wallet\Wallet\User\Beneficiary\Collection;


use Wallet\Wallet\User\Collection\UserCollectionInterface;

interface BeneficiaryCollectionInterface
{
    /**
     * @param array $beneficiaries
     * @return BeneficiaryCollectionInterface
     */
    public static function fromArray(array $beneficiaries):BeneficiaryCollectionInterface;

    /**
     * @return array
     */
    public function toArray(): array ;
}
