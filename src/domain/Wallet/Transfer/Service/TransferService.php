<?php


namespace Wallet\Wallet\Transfer\Service;


use Wallet\Wallet\Account\Entity\AccountEntityInterface;
use Wallet\Wallet\Account\Entity\TransactionEntityInterface;
use Wallet\Wallet\Account\Service\AccountServiceInterface;
use Wallet\Wallet\Account\Entity\TransactionEntity;
use Wallet\Wallet\Account\Service\AccountTransactionServiceInterface;
use Wallet\Wallet\Transfer\Entity\TransferEntityInterface;
use Wallet\Wallet\User\Beneficiary\Service\UserBeneficiaryService;
use Wallet\Wallet\User\Service\UserServiceInterface;

class TransferService implements TransferServiceInterface
{
    /**
     * @var AccountServiceInterface
     */
    private $accountService;

    /**
     * @var UserBeneficiaryService
     */
    private $userBeneficiaryService;

    /**
     * @var AccountTransactionServiceInterface
     */
    private $transactionService;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * TransferService constructor.
     * @param AccountServiceInterface $accountService
     * @param UserBeneficiaryService $userBeneficiaryService
     * @param AccountTransactionServiceInterface $transactionService
     * @param UserServiceInterface $userService
     */
    public function __construct(
        AccountServiceInterface $accountService,
        UserBeneficiaryService $userBeneficiaryService,
        AccountTransactionServiceInterface $transactionService,
        UserServiceInterface $userService
    ){
        $this->accountService = $accountService;
        $this->userBeneficiaryService = $userBeneficiaryService;
        $this->transactionService = $transactionService;
        $this->userService = $userService;
    }


    /**
     * @inheritDoc
     */
    public function create(
        TransferEntityInterface $transferEntity
    ): TransferEntityInterface
    {
        // Debit Sender Account
        $senderAccount = $this->accountService->fetchWithAccountId(
            $transferEntity->senderAccountId()
        );

        $sender = $this
            ->userService
            ->fetch(
                $senderAccount->getUserId()
            );

        $this
            ->accountService
            ->debit(
                $senderAccount->getUserId(),
                $transferEntity->senderAccountId(),
                $senderAccount->getOrganizations(),
                $transferEntity->getAmount()
            );

        $userBeneficiary = $this->userBeneficiaryService->fetch(
            $transferEntity->getBeneficiaryId(),
            $senderAccount->getUserId()
        );

        $this
            ->transactionService
            ->create(
                new TransactionEntity(
                    TransactionEntityInterface::TRANSACTION_TYPE_DEBIT,
                    $senderAccount->getUserId(),
                    $transferEntity->senderAccountId(),
                    $transferEntity->getAmount(),
                    sprintf('Transfer to %s', $userBeneficiary->getBeneficiaryName()),
                    current($senderAccount->getOrganizations()),
                    ''
                )
            );

        // TopUp Receiver Account
        $receiverAccount = $this->accountService->fetchWithAccountId(
            $userBeneficiary->getBeneficiaryAccountIdentifierValueFor(
                'WALLET_ACCOUNT',
                'WALLET_ACCOUNT_ID'
            )
        );

       $this
           ->accountService
           ->topUp(
               $receiverAccount->getUserId(),
               $receiverAccount->getAccountId(),
               $receiverAccount->getOrganizations(),
               $transferEntity->getAmount()
           );

        $this
            ->transactionService
            ->create(
                new TransactionEntity(
                    TransactionEntityInterface::TRANSACTION_TYPE_CREDIT,
                    $receiverAccount->getUserId(),
                    $receiverAccount->getAccountId(),
                    $transferEntity->getAmount(),
                    sprintf('Received from %s %s', $sender->getFirstName(), $sender->getLastName()),
                    current($receiverAccount->getOrganizations()),
                    ''
                )
            );

       return $transferEntity;
    }

    public function nameFormat(
        AccountEntityInterface $accountEntity
    ): string {
        $senderDetail = "";

        if ($accountEntity->getAccountType() == "personal")
        {
            $sender = $this
                ->userService
                ->fetch(
                    $accountEntity->getUserId()
                );
            $senderDetail = sprintf('%s %s', $sender->getFirstName(), $sender->getLastName());
        } else {
            if ($accountEntity->getAccountType() == "tontine")
                $senderDetail = sprintf('Tontine %s', $accountEntity->getName());
            else
                $senderDetail = $accountEntity->getName();
        }

        return $senderDetail;
    }

    /**
     * @inheritDoc
     */
    public function walletToWallet(
        TransferEntityInterface $transferEntity
    ): TransferEntityInterface {
        // Debit Sender Account
        $senderAccount = $this->accountService->fetchWithAccountId(
            $transferEntity->senderAccountId()
        );

        $this
            ->accountService
            ->debit(
                $senderAccount->getUserId(),
                $transferEntity->senderAccountId(),
                $senderAccount->getOrganizations(),
                $transferEntity->getAmount()
            );

        // TopUp Receiver Account
        $receiverAccount = $this->accountService->fetchWithAccountId(
            $transferEntity->receiverAccountId()
        );


        $this
            ->transactionService
            ->create(
                new TransactionEntity(
                    TransactionEntityInterface::TRANSACTION_TYPE_DEBIT,
                    $senderAccount->getUserId(),
                    $transferEntity->senderAccountId(),
                    $transferEntity->getAmount(),
                    sprintf('Transfer to %s', $this->nameFormat($receiverAccount)),
                    current($senderAccount->getOrganizations()),
                    ''
                )
            );

        $this
            ->accountService
            ->topUp(
                $receiverAccount->getUserId(),
                $receiverAccount->getAccountId(),
                $receiverAccount->getOrganizations(),
                $transferEntity->getAmount()
            );

        $this
            ->transactionService
            ->create(
                new TransactionEntity(
                    TransactionEntityInterface::TRANSACTION_TYPE_CREDIT,
                    $receiverAccount->getUserId(),
                    $receiverAccount->getAccountId(),
                    $transferEntity->getAmount(),
                    sprintf('Received from %s ', $this->nameFormat($senderAccount)),
                    current($receiverAccount->getOrganizations()),
                    ''
                )
            );

        return $transferEntity;
    }
}
