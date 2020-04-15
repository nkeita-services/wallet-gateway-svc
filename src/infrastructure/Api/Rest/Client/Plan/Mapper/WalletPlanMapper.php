<?php


namespace Infrastructure\Api\Rest\Client\Plan\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Plan\Entity\WalletPlanEntity;
use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

class WalletPlanMapper implements WalletPlanMapperInterface
{

    /**
     * @inheritDoc
     */
    public function createWalletPlanFromApiResponse(
        ResponseInterface $response
    ): WalletPlanEntityInterface{
        $walletPlanData = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return WalletPlanEntity::fromArray(
            $walletPlanData['data']['walletPlan']
        );
    }
}
