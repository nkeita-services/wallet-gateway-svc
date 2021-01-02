<?php


namespace App\Http\Controllers\Wallet\Fee\Region;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\Fee\Region\Mapper\RegionMapper;
use App\Http\Controllers\Wallet\Fee\Region\Mapper\RegionMapperInterface;
use Illuminate\Http\Request;
use Wallet\Wallet\Fee\Region\Service\RegionService;
use Wallet\Wallet\Fee\Region\Service\RegionServiceInterface;

class CreateRegionController extends Controller
{
    /**
     * @var RegionServiceInterface
     */
    private $regionService;

    /**
     * @var RegionMapperInterface
     */
    private $regionMapper;

    /**
     * CreateRegionController constructor.
     * @param RegionService $regionService
     * @param RegionMapper $regionMapper
     */
    public function __construct(
        RegionService $regionService,
        RegionMapper $regionMapper
    )
    {
        $this->regionService = $regionService;
        $this->regionMapper = $regionMapper;
    }

    public function create(Request $request)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'WalletRegion' => $this
                        ->regionService
                        ->create(
                            $this->regionMapper->createRegionFromHttpRequest(
                                $request
                            )
                        )
                        ->toArray()
                ]
            ]
        );
    }
}
