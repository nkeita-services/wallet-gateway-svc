<?php


namespace Infrastructure\Api\Rest\Client\Fee\Fee;


use Infrastructure\Api\Rest\Client\Fee\Fee\Exception\FeeNotFoundException;
use Wallet\Wallet\Fee\Fee\Collection\FeeCollectionInterface;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;

interface FeeApiClientInterface
{
    /**
     * @param array $regionCreatePayload
     * @return FeeEntityInterface
     */
    public function create(
        array $regionCreatePayload
    ): FeeEntityInterface;

    /**
     * @param string $feeId
     * @return FeeEntityInterface
     * @throws FeeNotFoundException
     */
    public function get(
        string $feeId
    ): FeeEntityInterface;


    /**
     * @param array $filters
     * @return FeeCollectionInterface
     */
    public function fetchAll(
        array $filters
    ): FeeCollectionInterface;
}
