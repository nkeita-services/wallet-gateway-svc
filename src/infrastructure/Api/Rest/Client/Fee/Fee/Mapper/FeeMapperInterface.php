<?php


namespace Infrastructure\Api\Rest\Client\Fee\Fee\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Fee\Fee\Collection\FeeCollectionInterface;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;

interface FeeMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return FeeEntityInterface
     */
    public function createFeeFromApiResponse(
        ResponseInterface $response
    ):FeeEntityInterface;

    /**
     * @param ResponseInterface $response
     * @return FeeCollectionInterface
     */
    public function createFeeCollectionFromApiResponse(
        ResponseInterface $response
    ): FeeCollectionInterface;
}
