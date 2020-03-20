<?php


namespace App\Http\Controllers\Wallet\Account;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Account\Service\AccountService;
use Wallet\Account\Service\AccountServiceInterface;

class UpdateAccountBalanceController  extends Controller
{
    /**
     * @var AccountServiceInterface
     */
    private $accountService;

    /**
     * FetchUserAccountsController constructor.
     * @param AccountService $accountService
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function topUp(
        $userId,
        $accountId,
        Request $request)
    {
        if (!$request->get('ApiConsumer')->hasScope('wallet-gateway/TopUpAccount')) {
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
                    'walletAccount' => $this->accountService->topUp(
                        $userId,
                        $accountId,
                        $request->get('ApiConsumer')->getOrganizations(),
                        $request->json()->get('amount')
                    )->toArray()
                ]
            ]

        );
    }

    public function debit(
        $userId,
        $accountId,
        Request $request)
    {
        if (!$request->get('ApiConsumer')->hasScope('wallet-gateway/DebitAccount')) {
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
                    'walletAccount' => $this->accountService->debit(
                        $userId,
                        $accountId,
                        $request->get('ApiConsumer')->getOrganizations(),
                        $request->json()->get('amount')
                    )->toArray()
                ]
            ]

        );
    }
}
