<?php


namespace Infrastructure\Api\Rest\Client\Plan;


use GuzzleHttp\Client;
use Infrastructure\Api\Rest\Client\Plan\Mapper\WalletPlanMapperInterface;
use Wallet\Wallet\Plan\Entity\WalletPlanEntityInterface;

class WalletPlanApiGuzzleHttpClient implements WalletPlanApiClientInterface
{

    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var WalletPlanMapperInterface
     */
    private $walletPlanMapper;

    /**
     * WalletPlanApiGuzzleHttpClient constructor.
     * @param Client $guzzleClient
     * @param WalletPlanMapperInterface $walletPlanMapper
     */
    public function __construct(
        Client $guzzleClient,
        WalletPlanMapperInterface $walletPlanMapper){
        $this->guzzleClient = $guzzleClient;
        $this->walletPlanMapper = $walletPlanMapper;
    }


    /**
     * @inheritDoc
     */
    public function get(
        string $planId
    ): WalletPlanEntityInterface
    {
        $response = $this->guzzleClient->get(
            sprintf('/v1/plans/%s', $planId)
        );

        return $this->walletPlanMapper->createWalletPlanFromApiResponse(
            $response
        );
    }
}
