<?php


namespace App\Http\Controllers\Wallet\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\Account\Mapper\AccountMapper;
use App\Http\Controllers\Wallet\Account\Mapper\AccountMapperInterface;
use App\Rules\Wallet\WalletPlanIdRule;
use App\Rules\Wallet\WalletUserIdRule;
use Illuminate\Http\Request;
use Wallet\Wallet\Account\Service\AccountService;
use Wallet\Wallet\Account\Service\AccountServiceInterface;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make(
            array_merge(
                $request->all(),
                ['userId'=> $userId]
            ),
            [
                'userId' => ['required', 'string', app(WalletUserIdRule::class)],
                'walletPlanId' => ['required', 'string', app(WalletPlanIdRule::class)],
                'accountType' => [
                    'required',
                    'string',
                    Rule::in(
                        ['personal', 'business', 'tontine']
                    )],
                'name' => ['required', 'string']
            ]
        );

        if($validator->fails()){
            return response()->json(
                [
                    'status' => 'error',
                    'statusCode'=> 0,
                    'statusDescription'=> $validator->errors()
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
