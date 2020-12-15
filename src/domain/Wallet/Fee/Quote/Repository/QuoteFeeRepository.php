<?php


namespace Wallet\Wallet\Fee\Quote\Repository;


use Infrastructure\Api\Rest\Client\Fee\Quote\QuoteFeeApiClientInterface;
use Wallet\Wallet\Fee\Quote\Entity\QuoteFeeEntityInterface;
use Wallet\Wallet\Fee\Transaction\TransactionEntityInterface;

class QuoteFeeRepository implements QuoteFeeRepositoryInterface
{

    /**
     * @var QuoteFeeApiClientInterface
     */
    private $quoteFeeApiClient;

    /**
     * WalletPlanRepository constructor.
     * @param QuoteFeeApiClientInterface $quoteFeeApiClient
     */
    public function __construct(
        QuoteFeeApiClientInterface $quoteFeeApiClient
    ){
        $this->quoteFeeApiClient = $quoteFeeApiClient;
    }

    /**
     * @param TransactionEntityInterface $transactionEntity
     * @return QuoteFeeEntityInterface
     */
    public function getQuote(
        TransactionEntityInterface $transactionEntity
    ) : QuoteFeeEntityInterface
    {
        return $this
            ->quoteFeeApiClient
            ->getQuote(
                $transactionEntity->toArray()
            );
    }
}
