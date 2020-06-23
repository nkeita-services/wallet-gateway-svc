<?php


namespace Wallet\Wallet\User\Beneficiary\Repository;


use Wallet\Wallet\User\Beneficiary\Collection\BeneficiaryCollectionInterface;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntityInterface;

interface UserBeneficiaryRepositoryInterface
{
    /**
     * @param BeneficiaryEntityInterface $beneficiaryEntity
     * @param string $userId
     * @return BeneficiaryEntityInterface
     */
    public function create(
        BeneficiaryEntityInterface $beneficiaryEntity,
        string $userId
    ): BeneficiaryEntityInterface;

    /**
     * @param string $beneficiaryId
     * @param string $userId
     * @return BeneficiaryEntityInterface
     */
    public function fetch(
        string $beneficiaryId,
        string $userId
    ): BeneficiaryEntityInterface;

    /**
     * @param $filter
     * @param string $userId
     * @return BeneficiaryCollectionInterface
     */
    public function fetchAll(
        $filter,
        string $userId
    ): BeneficiaryCollectionInterface;

}
