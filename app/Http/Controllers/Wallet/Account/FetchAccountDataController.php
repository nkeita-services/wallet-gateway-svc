<?php


namespace App\Http\Controllers\Wallet\Account;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Account\Service\AccountService;
use Wallet\Account\Service\AccountServiceInterface;

class FetchAccountDataController extends Controller
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

    public function fetch($accountId, Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccount' => $this->accountService->fetchWithAccountId(
                        $accountId
                    )->toArray()
                ]
            ]
        );
    }
}
