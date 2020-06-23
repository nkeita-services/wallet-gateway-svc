<?php


namespace Wallet\Wallet\Transfer\Service;


use Wallet\Account\Service\AccountServiceInterface;
use Wallet\Wallet\Transfer\Entity\TransferEntityInterface;
use Wallet\Wallet\User\Beneficiary\Service\UserBeneficiaryService;

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
     * TransferService constructor.
     * @param AccountServiceInterface $accountService
     * @param UserBeneficiaryService $userBeneficiaryService
     */
    public function __construct(
        AccountServiceInterface $accountService,
        UserBeneficiaryService $userBeneficiaryService
    ){
        $this->accountService = $accountService;
        $this->userBeneficiaryService = $userBeneficiaryService;
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

        $this
            ->accountService
            ->debit(
                $senderAccount->getUserId(),
                $transferEntity->senderAccountId(),
                $senderAccount->getOrganizations(),
                $transferEntity->getAmount()
            );

        // TopUp Receiver Account
        $userBeneficiary = $this->userBeneficiaryService->fetch(
            $transferEntity->getBeneficiaryId(),
            $senderAccount->getUserId()
        );

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
               $transferEntity->receiverAccountId(),
               $receiverAccount->getOrganizations(),
               $transferEntity->getAmount()
           );

       return $transferEntity;
    }
}
