<?php


namespace Wallet\Wallet\User\Beneficiary\Repository;


use Infrastructure\Api\Rest\Client\User\Beneficiary\BeneficiaryApiClientInterface;
use Wallet\Wallet\User\Beneficiary\Collection\BeneficiaryCollectionInterface;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntityInterface;

class UserBeneficiaryRepository implements UserBeneficiaryRepositoryInterface
{

    /**
     * @var BeneficiaryApiClientInterface
     */
    private $beneficiaryApiClient;

    /**
     * UserBeneficiaryRepository constructor.
     * @param BeneficiaryApiClientInterface $beneficiaryApiClient
     */
    public function __construct(BeneficiaryApiClientInterface $beneficiaryApiClient)
    {
        $this->beneficiaryApiClient = $beneficiaryApiClient;
    }


    /**
     * @inheritDoc
     */
    public function create(BeneficiaryEntityInterface $beneficiaryEntity, string $userId): BeneficiaryEntityInterface
    {
        return $this
            ->beneficiaryApiClient
            ->create(
                $beneficiaryEntity->toArray(),
                $userId
            );
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $beneficiaryId, string $userId): BeneficiaryEntityInterface
    {
        return $this
            ->beneficiaryApiClient
            ->get(
                $beneficiaryId,
                $userId
            );
    }

    /**
     * @inheritDoc
     */
    public function fetchAll($filter, string $userId): BeneficiaryCollectionInterface
    {
        return $this
            ->beneficiaryApiClient
            ->fetchAll($filter, $userId);
    }
}
