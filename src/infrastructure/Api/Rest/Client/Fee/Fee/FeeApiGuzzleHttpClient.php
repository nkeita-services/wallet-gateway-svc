<?php


namespace Infrastructure\Api\Rest\Client\Fee\Fee;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Infrastructure\Api\Rest\Client\Fee\Fee\Exception\FeeNotFoundException;
use Infrastructure\Api\Rest\Client\Fee\Fee\Mapper\FeeMapperInterface;
use Infrastructure\Api\Rest\Client\Fee\Region\Exception\RegionNotFoundException;
use Wallet\Wallet\Fee\Fee\Collection\FeeCollectionInterface;
use Wallet\Wallet\Fee\Fee\Entity\FeeEntityInterface;

class FeeApiGuzzleHttpClient implements FeeApiClientInterface
{

    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var FeeMapperInterface
     */
    private $feeMapper;

    /**
     * FeeApiGuzzleHttpClient constructor.
     * @param Client $guzzleClient
     * @param FeeMapperInterface $feeMapper
     */
    public function __construct(
        Client $guzzleClient,
        FeeMapperInterface $feeMapper){
        $this->guzzleClient = $guzzleClient;
        $this->feeMapper = $feeMapper;
    }

    /**
     * @param array $feeCreatePayload
     * @return FeeEntityInterface
     */
    public function create(
        array $feeCreatePayload
    ): FeeEntityInterface
    {
        $response = $this->guzzleClient->post('/v1/fees', [
            RequestOptions::JSON => $feeCreatePayload
        ]);

        return $this
            ->feeMapper
            ->createFeeFromApiResponse(
                $response
            );
    }

    /**
     * @param string $feeId
     * @return FeeEntityInterface
     * @throws FeeNotFoundException
     */
    public function get(
        string $feeId
    ): FeeEntityInterface
    {
        try {
            $response = $this->guzzleClient->get(
                sprintf('/v1/fees/%s', $feeId)
            );
        } catch (ClientException $e) {
            if($e->getResponse()->getStatusCode() == 404){
                throw new RegionNotFoundException(
                    sprintf(' fee %s not found', $feeId)
                );
            }

            throw $e;
        }

        return $this->feeMapper->createFeeFromApiResponse(
            $response
        );
    }


    /**
     * @param array $filters
     * @return FeeCollectionInterface
     */
    public function fetchAll(
        array $filters
    ): FeeCollectionInterface
    {
        try {
            $response = $this->guzzleClient->get('/v1/fees');
        } catch (ClientException $e) {
            throw $e;
        }

        return $this->feeMapper->createFeeCollectionFromApiResponse(
            $response
        );
    }

    /**
     * @param string $feeId
     * @param array $feeUpdatePayload
     * @return FeeEntityInterface
     */
    public function update(
        string $feeId,
        array $feeUpdatePayload
    ): FeeEntityInterface
    {
        $response = $this->guzzleClient->patch(sprintf('/v1/fees/%s', $feeId), [
            RequestOptions::JSON => $feeUpdatePayload
        ]);

        return $this
            ->feeMapper
            ->createFeeFromApiResponse(
                $response
            );
    }
}
