<?php


namespace Wallet\Account\Service;

use Wallet\Account\Entity\AccountEntityInterface;
use Wallet\Wallet\Account\Repository\AccountRepositoryInterface;

class AccountService implements AccountServiceInterface
{
    /**
     * @var AccountRepositoryInterface
     */
    private $accountRepository;

    /**
     * AccountService constructor.
     * @param AccountRepositoryInterface $accountRepository
     */
    public function __construct(
        AccountRepositoryInterface $accountRepository
    ){
        $this->accountRepository = $accountRepository;
    }


    public function create(AccountEntityInterface $accountEntity): AccountEntityInterface
    {
        return $this->accountRepository->create($accountEntity);
    }
}
