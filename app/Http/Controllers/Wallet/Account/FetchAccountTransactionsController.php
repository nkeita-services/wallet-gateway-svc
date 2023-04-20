<?php


namespace App\Http\Controllers\Wallet\Account;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Wallet\Wallet\Account\Service\AccountTransactionService;
use Wallet\Wallet\Event\Entity\EventFilterEntity;

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
            $fromTimestamp = Carbon::createFromFormat(
                'm/d/Y H:i:s',
                $request->get('fromDate'))->getTimestamp();
        }

        if($request->has('toDate')) {
            $toTimestamp = Carbon::createFromFormat(
                'm/d/Y H:i:s',
                $request->get('toDate'))->getTimestamp();
        }

        $actions = ['AccountBalanceOperation'];

        if (in_array($request->get('type', null), ['Debit', 'Credit'])) {
            $actions = [
                sprintf('AccountBalanceOperation::%s', $request->get('type'))
            ];
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                     $this->accountTransactionService->fetchWithAccountIdAndDateRange(
                        EventFilterEntity::fromArray(
                            [
                                'entityId' => $accountId,
                                'entity' => 'WalletAccount',
                                'actions'=> $actions,
                                'fromTimestamp' => $fromTimestamp ?? null,
                                'toTimestamp' => $toTimestamp ?? null,
                                'page' =>  $request->get('page', 1),
                                'limit' => $request->get('limit', 10)
                            ]
                        )
                    )->toArray()
                ]
            ]
        );
    }
}
