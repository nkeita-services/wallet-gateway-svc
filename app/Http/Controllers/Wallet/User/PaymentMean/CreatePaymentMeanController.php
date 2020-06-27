<?php


namespace App\Http\Controllers\Wallet\User\PaymentMean;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\User\PaymentMean\Mapper\UserPaymentMeanHttpMapper;
use App\Http\Controllers\Wallet\User\PaymentMean\Mapper\UserPaymentMeanHttpMapperInterface;
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
     * @param UserPaymentMeanServiceInterface $userPaymentMeanService
     * @param UserPaymentMeanHttpMapperInterface $userPaymentMeanHttpMapper
     */
    public function __construct(
        UserPaymentMeanService $userPaymentMeanService,
        UserPaymentMeanHttpMapper $userPaymentMeanHttpMapper)
    {
        $this->userPaymentMeanService = $userPaymentMeanService;
        $this->userPaymentMeanHttpMapper = $userPaymentMeanHttpMapper;
    }


    public function create(
        string $userId,
        Request $request
    )
    {
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
