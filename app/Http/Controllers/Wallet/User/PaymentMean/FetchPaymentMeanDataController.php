<?php


namespace App\Http\Controllers\Wallet\User\PaymentMean;

use App\Http\Controllers\Controller;
use Wallet\Wallet\User\PaymentMean\Service\UserPaymentMeanService;
use Wallet\Wallet\User\PaymentMean\Service\UserPaymentMeanServiceInterface;


class FetchPaymentMeanDataController extends Controller
{

    /**
     * @var UserPaymentMeanServiceInterface
     */
    private $userPaymentMeanService;

    /**
     * FetchAllPaymentMeansController constructor.
     * @param UserPaymentMeanServiceInterface $userPaymentMeanService
     */
    public function __construct(
        UserPaymentMeanService $userPaymentMeanService)
    {
        $this->userPaymentMeanService = $userPaymentMeanService;
    }

    public function fetchAll(
        string $userId,
        string $paymentMeanId
    )
    {
        return [
            'status' => 'success',
            'data' => [
                'userPaymentMean'=> $this
                    ->userPaymentMeanService
                    ->fetch(
                        $paymentMeanId,
                        $userId
                    )
                    ->toArray()
            ]
        ];
    }
}
