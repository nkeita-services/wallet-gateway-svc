<?php


namespace Infrastructure\Api\Rest\Client\Plan\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

interface WalletPlanMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return WalletPlanEntityInterface
     */
    public function createWalletPlanFromApiResponse(
        ResponseInterface $response
    ):WalletPlanEntityInterface;
}
