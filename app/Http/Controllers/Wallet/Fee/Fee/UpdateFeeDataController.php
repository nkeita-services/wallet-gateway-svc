<?php


namespace App\Http\Controllers\Wallet\Fee\Fee;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\Fee\Fee\Mapper\FeeMapper;
use App\Http\Controllers\Wallet\Fee\Fee\Mapper\FeeMapperInterface;
use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Fee\Service\FeeService;
use Wallet\Wallet\Fee\Fee\Service\FeeServiceInterface;

class UpdateFeeDataController extends Controller
{
    /**
     * @var FeeServiceInterface
     */
    private $feeService;

    /**
     * @var FeeMapperInterface
     */
    private $feeMapper;

    /**
     * CreateRegionController constructor.
     * @param FeeService $feeService
     * @param FeeMapper $feeMapper
     */
    public function __construct(
        FeeService $feeService,
        FeeMapper $feeMapper
    )
    {
        $this->feeService = $feeService;
        $this->feeMapper = $feeMapper;
    }

    public function update($feeId, Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'WalletFee' => $this
                        ->feeService
                        ->update(
                            $feeId,
                            $this->feeMapper->createFeeFromHttpRequest(
                                $request
                            )
                        )
                        ->toArray()
                ]
            ]
        );
    }
}
