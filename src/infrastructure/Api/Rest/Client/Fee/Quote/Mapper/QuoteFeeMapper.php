<?php


namespace Infrastructure\Api\Rest\Client\Fee\Quote\Mapper;


use Psr\Http\Message\ResponseInterface;
use Wallet\Wallet\Fee\Quote\Entity\QuoteFeeEntityInterface;
use Wallet\Wallet\Fee\Quote\Entity\QuoteFeeEntity;

use Wallet\Wallet\Plan\Entity\WalletPlanEntity;

class QuoteFeeMapper implements QuoteFeeMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return QuoteFeeEntityInterface
     */
    public function createQuoteFeeFromApiResponse(
        ResponseInterface $response
    ):QuoteFeeEntityInterface
    {
        $quoteFeeData = json_decode(
            $response->getBody()->getContents(),
            true
        );


        return QuoteFeeEntity::fromArray(
            $quoteFeeData['data']['quote']
        );
    }
}
