<?php


namespace App\Http\Controllers\Wallet\Account;


use Illuminate\Http\Request;
use Wallet\Wallet\Account\Service\AccountTransactionService;

class FetchAccountTransactionsController
{
    /**
     * @var AccountTransactionService
     */
    private $accountTransactionService;

    /**
     * FetchAccountTransactionsController constructor.
     * @param AccountTransactionService $accountTransactionService
     */
    public function __construct(AccountTransactionService $accountTransactionService)
    {
        $this->accountTransactionService = $accountTransactionService;
    }


    public function fetchAll($userId,
                             $accountId,
                             Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccountTransactions' => $this->accountTransactionService->fetchWithAccountIdAndDateRange(
                        $accountId,
                        null,
                        null
                    )
                ]
            ]

        );
    }
}
