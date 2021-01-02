<?php


namespace App\Http\Controllers\Wallet\Fee\Region;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Region\Service\RegionServiceInterface;
use Wallet\Wallet\Plan\Service\WalletPlanServiceInterface;

class FetchAllRegionsController extends Controller
{
    /**
     * @var RegionServiceInterface
     */
    private $regionService;

    /**
     * FetchAllRegionController constructor.
     * @param RegionServiceInterface $regionService
     */
    public function __construct(RegionServiceInterface $regionService)
    {
        $this->regionService = $regionService;
    }

    public function fetchAll(Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'WalletRegions' => $this
                        ->regionService
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
