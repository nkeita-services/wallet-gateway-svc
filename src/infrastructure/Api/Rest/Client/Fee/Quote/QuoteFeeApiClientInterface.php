<?php


namespace Infrastructure\Api\Rest\Client\Fee\Quote;


use Wallet\Wallet\Fee\Quote\Entity\QuoteFeeEntityInterface;

interface QuoteFeeApiClientInterface
{
    /**
     * @param array $quoteFeePayload
     * @return QuoteFeeEntityInterface
     */
    public function getQuote(
        array $quoteFeePayload
    ): QuoteFeeEntityInterface;
}
