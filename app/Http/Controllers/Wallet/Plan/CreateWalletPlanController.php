<?php


namespace App\Http\Controllers\Wallet\Plan;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\Plan\Mapper\WalletPlanMapper;
use App\Http\Controllers\Wallet\Plan\Mapper\WalletPlanMapperInterface;
use Illuminate\Http\Request;
use Wallet\Wallet\Plan\Service\WalletPlanService;
use Wallet\Wallet\Plan\Service\WalletPlanServiceInterface;

class CreateWalletPlanController extends Controller
{

    /**
     * @var WalletPlanServiceInterface
     */
    private $walletPlanService;

    /**
     * @var WalletPlanMapperInterface
     */
    private $walletPlanMapper;

    /**
     * CreateWalletPlanController constructor.
     * @param WalletPlanService $walletPlanService
     * @param WalletPlanMapper $walletPlanMapper
     */
    public function __construct(
        WalletPlanService $walletPlanService,
        WalletPlanMapper $walletPlanMapper
    )
    {
        $this->walletPlanService = $walletPlanService;
        $this->walletPlanMapper = $walletPlanMapper;
    }


    public function create(Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletPlans' => $this
                        ->walletPlanService
                        ->create(
                            $this->walletPlanMapper->createWalletPlanFromHttpRequest(
                                $request
                            )
                        )
                        ->toArray()
                ]
            ]
        );
    }
}
