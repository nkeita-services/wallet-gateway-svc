<?php


namespace App\Http\Controllers\Wallet\Fee\Region;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Region\Service\RegionServiceInterface;

class FetchRegionDataController extends Controller
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

    public function fetch($regionId, Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletRegion' => $this
                        ->regionService
                        ->fetchWithRegionId(
                            $regionId
                        )
                        ->toArray()
                ]
            ]
        );
    }
}
