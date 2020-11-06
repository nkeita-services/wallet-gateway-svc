<?php


namespace App\Http\Controllers\Wallet\Organization\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Wallet\Account\Service\AccountServiceInterface;

class GetAccountDataController extends Controller
{
    /**
     * @var AccountServiceInterface
     */
    private $accountService;

    /**
     * FetchAccountsController constructor.
     * @param AccountServiceInterface $accountService
     */
    public function __construct(AccountServiceInterface $accountService)
    {
        $this->accountService = $accountService;
    }


    public function fetch(
        string $accountId,
        Request $request
    ){
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'OrganizationAccount' => $this->accountService->fetchWithAccountId(
                        $accountId
                    )->toArray()
                ]
            ]

        );
    }
}
