<?php


namespace App\Http\Controllers\Wallet\Account;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Wallet\Account\Service\AccountService;
use Wallet\Wallet\Account\Service\AccountServiceInterface;

class FetchUserPersonalAccountsController extends Controller
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
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccounts' => $this->accountService->fetchAllPersonalWithUserAndOrganizations(
                        $userId,
                        $request->get('ApiConsumer')->getOrganizations()
                    )->toArray()
                ]
            ]

        );
    }
}
