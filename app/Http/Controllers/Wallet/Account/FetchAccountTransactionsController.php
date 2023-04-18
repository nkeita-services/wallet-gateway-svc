<?php


namespace App\Http\Controllers\Wallet\Account;

use Carbon\Carbon;
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

        if($request->has('fromDate')) {
            $fromDate = Carbon::createFromFormat(
                'm/d/Y H:i:s',
                $request->get('fromDate'));
        }

        if($request->has('toDate')) {
            $toDate = Carbon::createFromFormat(
                'm/d/Y H:i:s',
                $request->get('toDate'));
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccountTransactions' => $this->accountTransactionService->fetchWithAccountIdAndDateRange(
                        $accountId,
                        $request->get('type', null),
                        $fromDate ?? null,
                        $toDate ?? null
                    )
                ]
            ]

        );
    }
}
