<?php


namespace Wallet\Wallet\Transfer\Service;


use Wallet\Account\Service\AccountServiceInterface;
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
    public function __construct(AccountServiceInterface $accountService, UserBeneficiaryService $userBeneficiaryService, AccountTransactionServiceInterface $transactionService, UserServiceInterface $userService)
    {
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
                    $senderAccount->getUserId(),
                    $transferEntity->senderAccountId(),
                    - $transferEntity->getAmount(),
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
}
