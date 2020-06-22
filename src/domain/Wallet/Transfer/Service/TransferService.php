<?php


namespace Wallet\Wallet\Transfer\Service;


use Wallet\Account\Service\AccountServiceInterface;
use Wallet\Wallet\Transfer\Entity\TransferEntityInterface;

class TransferService implements TransferServiceInterface
{
    /**
     * @var AccountServiceInterface
     */
    private $accountService;

    /**
     * TransferService constructor.
     * @param AccountServiceInterface $accountService
     */
    public function __construct(AccountServiceInterface $accountService)
    {
        $this->accountService = $accountService;
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
        $receiverAccount = $this->accountService->fetchWithAccountId(
            $transferEntity->receiverAccountId()
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
