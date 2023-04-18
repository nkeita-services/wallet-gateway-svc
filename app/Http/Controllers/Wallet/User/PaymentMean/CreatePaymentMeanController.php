<?php


namespace App\Http\Controllers\Wallet\User\PaymentMean;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\User\PaymentMean\Mapper\UserPaymentMeanHttpMapper;
use App\Http\Controllers\Wallet\User\PaymentMean\Mapper\UserPaymentMeanHttpMapperInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Wallet\Wallet\User\PaymentMean\Service\UserPaymentMeanService;
use Wallet\Wallet\User\PaymentMean\Service\UserPaymentMeanServiceInterface;
use Illuminate\Http\Request;


class CreatePaymentMeanController extends Controller
{

    /**
     * @var UserPaymentMeanServiceInterface
     */
    private $userPaymentMeanService;

    /**
     * @var UserPaymentMeanHttpMapperInterface
     */
    private $userPaymentMeanHttpMapper;

    /**
     * CreatePaymentMeanController constructor.
     * @param UserPaymentMeanService $userPaymentMeanService
     * @param UserPaymentMeanHttpMapper $userPaymentMeanHttpMapper
     */
    public function __construct(
        UserPaymentMeanService $userPaymentMeanService,
        UserPaymentMeanHttpMapper $userPaymentMeanHttpMapper)
    {
        $this->userPaymentMeanService = $userPaymentMeanService;
        $this->userPaymentMeanHttpMapper = $userPaymentMeanHttpMapper;
    }

    /**
     * @param string $userId
     * @param Request $request
     * @return array
     */
    public function create(
        string $userId,
        Request $request
    ) {

        $validator = Validator::make(
            $request->json()->all(),
            [
                'type' => [
                    'required', 'string',
                    Rule::in(
                        [
                            "BANK_ACCOUNT", "DEBIT_CARD", "E_WALLET"
                        ]
                    )
                ]
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'statusCode' => "0000",
                    'statusDescription' => $validator->errors()
                ]
            );
        }
        return [
            'status' => 'success',
            'data' => [
                'userPaymentMean'=> $this
                    ->userPaymentMeanService
                    ->create(
                        $this->userPaymentMeanHttpMapper::createUserPaymentMeanFromHttpRequest(
                            $request
                        ),
                        $userId
                    )
                    ->toArray()
            ]

        ];
    }
}
