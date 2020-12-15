<?php


namespace App\Http\Controllers\Wallet\Fee\Fee;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Fee\Service\FeeServiceInterface;

class FetchAllfeesController  extends Controller
{
    /**
     * @var FeeServiceInterface
     */
    private $feeService;

    /**
     * FetchAllFeeController constructor.
     * @param FeeServiceInterface $feeService
     */
    public function __construct(FeeServiceInterface $feeService)
    {
        $this->feeService = $feeService;
    }

    public function fetchAll(Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'WalletFees' => $this
                        ->feeService
                        ->fetchAll(
                            $request
                                ->json()
                                ->all()
                        )
                        ->toArray()
                ]
            ]
        );
    }
}
