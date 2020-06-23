<?php


namespace Infrastructure\Api\Rest\Client\User\Beneficiary;


use Infrastructure\Api\Rest\Client\User\Exception\UserNotFoundException;
use Wallet\Wallet\User\Beneficiary\Collection\BeneficiaryCollectionInterface;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntityInterface;

interface BeneficiaryApiClientInterface
{
    /**
     * @param array $beneficiaryPayload
     * @param string $userId
     * @return BeneficiaryEntityInterface
     */
    public function create(
        array $beneficiaryPayload,
        string $userId
    ): BeneficiaryEntityInterface;

    /**
     * @param string $beneficiaryId
     * @param string $userId
     * @return BeneficiaryEntityInterface
     */
    public function get(
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
