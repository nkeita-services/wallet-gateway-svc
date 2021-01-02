<?php


namespace Wallet\Wallet\Fee\Fee\Repository;


use Wallet\Wallet\Fee\Fee\Collection\FeeCollectionInterface;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;
use Wallet\Wallet\Fee\Fee\Repository\Exception\FeeNotFoundException;

interface FeeRepositoryInterface
{
    /**
     * @param FeeEntityInterface $regionEntity
     * @return FeeEntityInterface
     */
    public function create(
        FeeEntityInterface $regionEntity
    ): FeeEntityInterface;

    /**
     * @param string $regionId
     * @return FeeEntityInterface
     * @throws FeeNotFoundException
     */
    public function fetchWithFeeId(
        string $regionId
    ): FeeEntityInterface;

    /**
     * @param array $filter
     * @return FeeCollectionInterface
     */
    public function fetchAll(
        array $filter
    ): FeeCollectionInterface;
}
