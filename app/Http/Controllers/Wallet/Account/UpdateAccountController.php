<?php


namespace App\Http\Controllers\Wallet\Account;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Account\Service\AccountService;
use Wallet\Account\Service\AccountServiceInterface;

class UpdateAccountController extends Controller
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

    public function update(
        $userId,
        $accountId,
        Request $request){

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccount' => $this->accountService->updateWithUserAndAccountAndOrganizations(
                        $userId,
                        $accountId,
                        $request->get('ApiConsumer')->getOrganizations(),
                        [
                            'balance' => $request->json()->get('balance')
                        ]
                    )->toArray()
                ]
            ]

        );
    }
}
