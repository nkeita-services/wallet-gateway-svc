<?php


namespace App\Http\Controllers\Wallet\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\Account\Mapper\AccountMapper;
use App\Http\Controllers\Wallet\Account\Mapper\AccountMapperInterface;
use Illuminate\Http\Request;
use Wallet\Account\Service\AccountService;
use Wallet\Account\Service\AccountServiceInterface;

class CreateAccountController extends Controller
{
    /**
     * @var AccountServiceInterface
     */
    private $accountService;

    /**
     * @var AccountMapperInterface
     */
    private $accountMapper;


    public function __construct(
        AccountService $accountService,
        AccountMapper $accountMapper)
    {
        $this->accountService = $accountService;
        $this->accountMapper = $accountMapper;
    }

    public function create($userId, Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccount' => $this->accountService->create(
                        $this->accountMapper::createAccountFromHttpRequest(
                            $request
                        ),
                        $userId,
                        $request->get('ApiConsumer')->getOrganizations()
                    )->toArray()
                ]
            ]

        );
    }
}
