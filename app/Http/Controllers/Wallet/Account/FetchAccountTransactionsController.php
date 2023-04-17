<?php


namespace App\Http\Controllers\Wallet\Account;


use Illuminate\Http\JsonResponse;
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

    /**
     * @param $userId
     * @param $accountId
     * @param Request $request
     * @return JsonResponse
     */
    public function fetchAll(
        $userId,
        $accountId,
        Request $request
    ) {

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccountTransactions' => $this->accountTransactionService->fetchWithAccountIdAndDateRange(
                        $accountId,
                        $request->get('type', null),
                        $request->get('fromDta', null),
                        $request->get('toDate', null)
                    )
                ]
            ]

        );
    }
}
