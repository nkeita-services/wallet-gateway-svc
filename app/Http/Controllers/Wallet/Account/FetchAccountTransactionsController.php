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
        if (!$request->get('ApiConsumer')->hasScope('wallet-gateway/GetAccountTransactions')) {
            return response()->json(
                [
                    'status' => 'failure',
                    'statusCode' => 0,
                    'statusDescription' => "You don't seem to have enough permissions to perform this action"
                ],
                401
            );
        }

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
