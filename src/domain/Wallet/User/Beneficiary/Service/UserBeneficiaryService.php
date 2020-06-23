<?php


namespace Wallet\Wallet\User\Beneficiary\Service;


use Wallet\Wallet\User\Beneficiary\Collection\BeneficiaryCollectionInterface;
use Wallet\Wallet\User\Beneficiary\Entity\BeneficiaryEntityInterface;
use Wallet\Wallet\User\Beneficiary\Repository\UserBeneficiaryRepositoryInterface;

class UserBeneficiaryService implements UserBeneficiaryServiceInterface
{

    /**
     * @var UserBeneficiaryRepositoryInterface
     */
    private $userBeneficiaryRepository;

    /**
     * UserBeneficiaryService constructor.
     * @param UserBeneficiaryRepositoryInterface $userBeneficiaryRepository
     */
    public function __construct(UserBeneficiaryRepositoryInterface $userBeneficiaryRepository)
    {
        $this->userBeneficiaryRepository = $userBeneficiaryRepository;
    }


    /**
     * @inheritDoc
     */
    public function create(BeneficiaryEntityInterface $beneficiaryEntity, string $userId): BeneficiaryEntityInterface
    {
        return $this
            ->userBeneficiaryRepository
            ->create(
                $beneficiaryEntity,
                $userId
            );
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $beneficiaryId, string $userId): BeneficiaryEntityInterface
    {
        return $this
            ->userBeneficiaryRepository
            ->fetch(
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
            ->userBeneficiaryRepository
            ->fetchAll(
                $filter,
                $userId
            );
    }
}
