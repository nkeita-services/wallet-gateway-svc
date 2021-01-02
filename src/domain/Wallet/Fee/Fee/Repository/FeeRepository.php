<?php


namespace Wallet\Wallet\Fee\Fee\Repository;


use Infrastructure\Api\Rest\Client\Fee\Fee\FeeApiClientInterface;
use Wallet\Wallet\Fee\Fee\Collection\FeeCollectionInterface;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;
use Wallet\Wallet\Fee\Fee\Repository\Exception\FeeNotFoundException;

class FeeRepository implements FeeRepositoryInterface
{
    /**
     * @var FeeApiClientInterface
     */
    private $feeApiClient;

    /**
     * FeeRepository constructor.
     * @param FeeApiClientInterface $feeApiClient
     */
    public function __construct(
        FeeApiClientInterface $feeApiClient
    ){
        $this->feeApiClient = $feeApiClient;
    }


    /**
     * @param FeeEntityInterface $feeEntity
     * @return FeeEntityInterface
     */
    public function create(
        FeeEntityInterface $feeEntity
    ): FeeEntityInterface
    {
        return $this
            ->feeApiClient
            ->create(
                $feeEntity->toArray()
            );
    }

    /**
     * @param string $regionId
     * @return FeeEntityInterface
     * @throws FeeNotFoundException
     */
    public function fetchWithFeeId(
        string $regionId
    ): FeeEntityInterface
    {
        try {
            return $this
                ->feeApiClient
                ->get(
                    $regionId
                );
        } catch (FeeNotFoundException $e) {
            throw new FeeNotFoundException(
                $e->getMessage()
            );
        }
    }

    /**
     * @param array $filter
     * @return FeeCollectionInterface
     */
    public function fetchAll(
        array $filter
    ): FeeCollectionInterface
    {
        return $this
            ->feeApiClient
            ->fetchAll($filter);
    }
}
