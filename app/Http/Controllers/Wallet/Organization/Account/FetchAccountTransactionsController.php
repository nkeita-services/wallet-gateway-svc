<?php


namespace App\Http\Controllers\Wallet\Organization\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Wallet\Account\Service\AccountTransactionService;

class FetchAccountTransactionsController extends Controller
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


    public function fetchAll(
        $accountId,
        Request $request
    ){
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
