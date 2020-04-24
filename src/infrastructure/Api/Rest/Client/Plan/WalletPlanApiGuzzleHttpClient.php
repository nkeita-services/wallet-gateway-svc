<?php


namespace Infrastructure\Api\Rest\Client\Plan;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Infrastructure\Api\Rest\Client\Plan\Exception\WalletPlanNotFoundException;
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
        try {
            $response = $this->guzzleClient->get(
                sprintf('/v1/plans/%s', $planId)
            );
        } catch (ClientException $e) {
            if($e->getResponse()->getStatusCode() == 404){
                throw new WalletPlanNotFoundException(
                    sprintf('wallet plan %s not found', $planId)
                );
            }

            throw $e;
        }

        return $this->walletPlanMapper->createWalletPlanFromApiResponse(
            $response
        );
    }
}
