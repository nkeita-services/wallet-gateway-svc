<?php


namespace Infrastructure\Api\Rest\Client\Fee\Quote\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Fee\Quote\Entity\QuoteFeeEntityInterface;

interface QuoteFeeMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return QuoteFeeEntityInterface
     */
    public function createQuoteFeeFromApiResponse(
        ResponseInterface $response
    ):QuoteFeeEntityInterface;

}
