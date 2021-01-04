<?php


namespace Wallet\Wallet\Fee\Quote\Service;


use Wallet\Wallet\Fee\Quote\Entity\QuoteFeeEntityInterface;
use Wallet\Wallet\Fee\Quote\Entity\QuoteFeeEntity;
use Wallet\Wallet\Fee\Quote\Repository\QuoteFeeRepositoryInterface;
use Wallet\Wallet\Fee\Transaction\TransactionEntityInterface;

class QuoteFeeService implements QuoteFeeServiceInterface
{
    const NBK = "Nbk";
    /**
     * @var QuoteFeeRepositoryInterface
     */
    private $quoteFeeRepository;

    /**
     * QuoteFeeService constructor.
     * @param QuoteFeeRepositoryInterface $quoteFeeRepository
     */
    public function __construct(
        QuoteFeeRepositoryInterface $quoteFeeRepository
    )
    {
        $this->quoteFeeRepository = $quoteFeeRepository;
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
            ->quoteFeeRepository
            ->getQuote(
                $transactionEntity
            );
    }

    /**
     * @param TransactionEntityInterface $transactionEntity
     * @return QuoteFeeEntityInterface
     */
    public function getQuotes(
        TransactionEntityInterface $transactionEntity
    ) : QuoteFeeEntityInterface
    {
        $paymentMean = $this->getQuote(
            $transactionEntity
        );


        $nbk =  $this->getQuote(
            $transactionEntity
                ->setPaymentMean(
                    self::NBK
                )
        );

        return QuoteFeeEntity::fromArray([
            'walletOrganizations' => $paymentMean->getWalletOrganizations(),
            'regionId' => $paymentMean->getRegionId(),
            'paymentMean' => $paymentMean->getPaymentMean(),
            'nbk' => $nbk->getPaymentMean()
        ]);

    }
}
