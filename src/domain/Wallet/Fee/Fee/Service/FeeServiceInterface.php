<?php


namespace Wallet\Wallet\Fee\Fee\Service;


use Wallet\Wallet\Fee\Fee\Collection\FeeCollectionInterface;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;
use Wallet\Wallet\Fee\Fee\Service\Exception\FeeNotFoundException;

interface FeeServiceInterface
{
    /**
     * @param FeeEntityInterface $feeEntity
     * @return FeeEntityInterface
     */
    public function create(
        FeeEntityInterface $feeEntity
    ): FeeEntityInterface;

    /**
     * @param string $feeId
     * @return FeeEntityInterface
     * @throws feeNotFoundException
     */
    public function fetchWithFeeId(
        string $feeId
    ): FeeEntityInterface;

    /**
     * @param array $filter
     * @return feeCollectionInterface
     */
    public function fetchAll(
        array $filter
    ): feeCollectionInterface;
}
