<?php


namespace App\Http\Controllers\Wallet\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\Account\Mapper\AccountMapper;
use App\Http\Controllers\Wallet\Account\Mapper\AccountMapperInterface;
use App\Rules\Wallet\WalletPlanIdRule;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Wallet\Account\Service\AccountService;
use Wallet\Account\Service\AccountServiceInterface;
use Illuminate\Validation\Rule;

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
        try {
            $this
                ->validate($request, [
                    'walletPlanId' => ['required', 'string', app(WalletPlanIdRule::class)],
                    'accountType' => ['required', 'string', Rule::in(['personal', 'business'])],
                    'name' => ['required', 'string']
                ]);
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode'=> 0,
                    'StatusDescription'=> $e->validator->errors()
                ]
            );
        }

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
