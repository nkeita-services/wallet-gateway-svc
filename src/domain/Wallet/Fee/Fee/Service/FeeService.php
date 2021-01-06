<?php


namespace Wallet\Wallet\Fee\Fee\Service;


use Wallet\Wallet\Fee\Fee\Collection\FeeCollectionInterface;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;
use Wallet\Wallet\Fee\Fee\Repository\FeeRepositoryInterface;
use Wallet\Wallet\Fee\Fee\Service\Exception\FeeNotFoundException;

class FeeService implements FeeServiceInterface
{
    /**
     * @var FeeRepositoryInterface
     */
    private $feeRepository;

    /**
     * FeeService constructor.
     * @param FeeRepositoryInterface $feeRepository
     */
    public function __construct(
        FeeRepositoryInterface $feeRepository
    ){
        $this->feeRepository = $feeRepository;
    }

    /**
     * @param FeeEntityInterface $feeEntity
     * @return FeeEntityInterface
     */
    public function create(
        FeeEntityInterface $feeEntity
    ): FeeEntityInterface
    {
        return $this->feeRepository
            ->create($feeEntity);
    }

    /**
     * @param string $feeId
     * @return FeeEntityInterface
     * @throws feeNotFoundException
     */
    public function fetchWithFeeId(
        string $feeId
    ): FeeEntityInterface
    {
        try{
            return $this->feeRepository->fetchWithFeeId(
                $feeId
            );
        }catch (FeeNotFoundException $e){
            throw new FeeNotFoundException(
                $e->getMessage()
            );
        }
    }

    /**
     * @param array $filter
     * @return feeCollectionInterface
     */
    public function fetchAll(
        array $filter
    ): feeCollectionInterface
    {
        return $this->feeRepository->fetchAll($filter);
    }

    /**
     * @param string $feeId
     * @param FeeEntityInterface $feeEntity
     * @return FeeEntityInterface
     */
    public function update(
        string $feeId,
        FeeEntityInterface $feeEntity
    ): FeeEntityInterface {
        return $this->feeRepository
            ->update(
                $feeId,
                $feeEntity
            );
    }
}
