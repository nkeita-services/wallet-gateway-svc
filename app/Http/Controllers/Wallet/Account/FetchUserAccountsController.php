<?php


namespace App\Http\Controllers\Wallet\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Account\Service\AccountService;
use Wallet\Account\Service\AccountServiceInterface;

class FetchUserAccountsController extends Controller
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
    public function fetch($userId, Request $request)
    {
        if(!$request->get('ApiConsumer')->hasScope('wallet-gateway/ListUserAccounts')){
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
                'status'=>'success',
                'data'=> $this->accountService->fetch($userId)->toArray()
            ]

        );
    }

}
