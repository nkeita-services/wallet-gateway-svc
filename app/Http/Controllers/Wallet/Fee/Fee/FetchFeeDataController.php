<?php


namespace App\Http\Controllers\Wallet\Fee\Fee;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Fee\Service\FeeServiceInterface;

class FetchFeeDataController   extends Controller
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

    public function fetch($feeId, Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletFee' => $this
                        ->feeService
                        ->fetchWithFeeId(
                            $feeId
                        )
                        ->toArray()
                ]
            ]
        );
    }
}
