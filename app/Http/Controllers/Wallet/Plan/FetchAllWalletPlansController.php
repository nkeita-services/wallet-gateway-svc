<?php


namespace App\Http\Controllers\Wallet\Plan;

use App\Http\Controllers\Controller;
use Wallet\Wallet\Plan\Service\WalletPlanServiceInterface;

class FetchAllWalletPlansController extends Controller
{

    /**
     * @var WalletPlanServiceInterface
     */
    private $walletPlanService;

    /**
     * FetchAllWalletPlansController constructor.
     * @param WalletPlanServiceInterface $walletPlanService
     */
    public function __construct(WalletPlanServiceInterface $walletPlanService)
    {
        $this->walletPlanService = $walletPlanService;
    }

    public function fetchAll()
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletPlans' => $this
                        ->walletPlanService
                        ->fetchAll([])
                        ->toArray()
                ]
            ]
        );
    }
}
