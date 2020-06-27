<?php


namespace Infrastructure\Api\Rest\Client\User\PaymentMean\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\User\PaymentMean\Collection\PaymentMeanCollection;
use Wallet\Wallet\User\PaymentMean\Collection\PaymentMeanCollectionInterface;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntity;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntityInterface;

class UserUserPaymentMeanMapper implements UserPaymentMeanMapperInterface
{

    /**
     * @inheritDoc
     */
    public function createPaymentMeanFromApiResponse(ResponseInterface $response): PaymentMeanEntityInterface
    {
        $data = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return PaymentMeanEntity::fromArray(
            $data['data']['userPaymentMean']
        );
    }

    /**
     * @inheritDoc
     */
    public function createPaymentMeansCollectionFromApiResponse(ResponseInterface $response): PaymentMeanCollectionInterface
    {
        $data = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return PaymentMeanCollection::fromArray(
            $data['data']['userPaymentMeans']
        );
    }
}
