<?php


namespace App\Http\Controllers\Wallet\Plan;


use Illuminate\Http\Request;
use Wallet\Wallet\Plan\Service\WalletPlanService;
use Wallet\Wallet\Plan\Service\WalletPlanServiceInterface;

class FetchWalletPlanDataController
{

    /**
     * @var WalletPlanServiceInterface
     */
    private $walletPlanService;

    /**
     * FetchWalletPlanDataController constructor.
     * @param WalletPlanServiceInterface $walletPlanService
     */
    public function __construct(
        WalletPlanService $walletPlanService
    ){
        $this->walletPlanService = $walletPlanService;
    }


    public function fetch($planId, Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletPlan' => $this
                        ->walletPlanService
                        ->fromWalletPlanId($planId)
                        ->toArray()
                ]
            ]
        );
    }
}
