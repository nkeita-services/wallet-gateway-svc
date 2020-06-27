<?php


namespace Infrastructure\Api\Rest\Client\User\PaymentMean;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Infrastructure\Api\Rest\Client\User\PaymentMean\Exception\PaymentMeanNotFoundException;
use Infrastructure\Api\Rest\Client\User\PaymentMean\Mapper\UserPaymentMeanMapperInterface;
use Wallet\Wallet\User\PaymentMean\Collection\PaymentMeanCollectionInterface;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntityInterface;
use DomainException;

class UserPaymentMeanApiClient implements UserPaymentMeanApiClientInterface
{
    /**
     * @var UserPaymentMeanMapperInterface
     */
    private $userPaymentMeanMapper;


    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * UserPaymentMeanApiClient constructor.
     * @param UserPaymentMeanMapperInterface $userPaymentMeanMapper
     * @param Client $guzzleClient
     */
    public function __construct(
        UserPaymentMeanMapperInterface $userPaymentMeanMapper,
        Client $guzzleClient)
    {
        $this->userPaymentMeanMapper = $userPaymentMeanMapper;
        $this->guzzleClient = $guzzleClient;
    }


    /**
     * @inheritDoc
     */
    public function create(
        array $paymentMeanPayload,
        string $userId): PaymentMeanEntityInterface
    {
        $response = $this->guzzleClient->post(sprintf('/v1/users/%s/payment-means',$userId), [
            RequestOptions::JSON => $paymentMeanPayload
        ]);

        return $this->userPaymentMeanMapper->createPaymentMeanFromApiResponse(
            $response
        );
    }

    /**
     * @inheritDoc
     */
    public function get(string $paymentMeanId, string $userId): PaymentMeanEntityInterface
    {
        try {
            $response = $this->guzzleClient->get(
                sprintf('/v1/users/%s/payment-means/%s', $userId,$paymentMeanId)
            );
        } catch (ClientException $e) {
            if($e->getResponse()->getStatusCode() == 404){
                throw new PaymentMeanNotFoundException(
                    sprintf('Payment mean %s not found', $paymentMeanId)
                );
            }

            throw $e;
        }catch (ServerException $e){
            $decodedPayload = json_decode(
                $e->getResponse()->getBody()->getContents(), true
            );

            throw new DomainException(
                $decodedPayload['StatusDescription']
            );
        }

        return $this->userPaymentMeanMapper->createPaymentMeanFromApiResponse(
            $response
        );
    }

    /**
     * @inheritDoc
     */
    public function fetchAll($filter, string $userId): PaymentMeanCollectionInterface
    {
        try {
            $response = $this->guzzleClient->get(
                sprintf('/v1/users/%s/payment-means',$userId)
            );

            return $this->userPaymentMeanMapper->createPaymentMeansCollectionFromApiResponse(
                $response
            );
        } catch (ClientException $e) {
            throw $e;
        }
    }
}
