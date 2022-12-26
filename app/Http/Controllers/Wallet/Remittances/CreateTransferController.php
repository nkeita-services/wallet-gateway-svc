<?php


namespace App\Http\Controllers\Wallet\Remittances;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\Remittances\Mapper\TransferMapper;
use App\Http\Controllers\Wallet\Remittances\Mapper\TransferMapperInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Wallet\Wallet\Transfer\Service\TransferService;
use Wallet\Wallet\Transfer\Service\TransferServiceInterface;

class CreateTransferController extends Controller
{

    /**
     * @var TransferServiceInterface
     */
    private $transferService;

    /**
     * @var TransferMapperInterface
     */
    private $transferMapper;

    /**
     * CreateTransferController constructor.
     * @param TransferService $transferService
     * @param TransferMapper $transferMapper
     */
    public function __construct(
        TransferService $transferService,
        TransferMapper $transferMapper){
        $this->transferService = $transferService;
        $this->transferMapper = $transferMapper;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(
        Request $request
    ){
        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => [
                        'transfer' => $this->transferService->create(
                            $this->transferMapper::createTransferFromHttpRequest(
                                $request
                            )
                        )->toArray()
                    ]
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 404
            );
        }
    }
}
