<?php


namespace Infrastructure\Api\Rest\Client\User\PaymentMean\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\User\PaymentMean\Collection\PaymentMeanCollectionInterface;
use Wallet\Wallet\User\PaymentMean\Entity\PaymentMeanEntityInterface;

interface UserPaymentMeanMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return PaymentMeanEntityInterface
     */
    public function createPaymentMeanFromApiResponse(ResponseInterface $response):PaymentMeanEntityInterface;

    /**
     * @param ResponseInterface $response
     * @return PaymentMeanCollectionInterface
     */
    public function createPaymentMeansCollectionFromApiResponse(
        ResponseInterface $response
    ):PaymentMeanCollectionInterface;
}
