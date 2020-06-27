<?php


namespace App\Http\Controllers\Wallet\User\PaymentMean;

use App\Http\Controllers\Controller;
use Wallet\Wallet\User\PaymentMean\Service\UserPaymentMeanService;
use Wallet\Wallet\User\PaymentMean\Service\UserPaymentMeanServiceInterface;
use Illuminate\Http\Request;

class FetchAllPaymentMeansController extends Controller
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
        Request $request
    )
    {
        return [
            'status' => 'success',
            'data' => [
                'userPaymentMeans'=> $this
                ->userPaymentMeanService
                ->fetchAll(
                    [],
                    $userId
                )
                    ->toArray()
            ]
        ];
    }


}
