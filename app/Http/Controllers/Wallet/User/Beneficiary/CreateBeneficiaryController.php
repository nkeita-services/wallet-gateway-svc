<?php


namespace App\Http\Controllers\Wallet\User\Beneficiary;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\User\Beneficiary\Mapper\UserBeneficiaryHttpMapper;
use App\Http\Controllers\Wallet\User\Beneficiary\Mapper\UserBeneficiaryHttpMapperInterface;
use Illuminate\Http\Request;
use Wallet\Wallet\User\Beneficiary\Service\UserBeneficiaryService;
use Wallet\Wallet\User\Beneficiary\Service\UserBeneficiaryServiceInterface;

class CreateBeneficiaryController extends Controller
{

    /**
     * @var UserBeneficiaryServiceInterface
     */
    private $userBeneficiaryService;

    /**
     * @var UserBeneficiaryHttpMapperInterface
     */
    private $userBeneficiaryHttpMapper;

    /**
     * CreateBeneficiaryController constructor.
     * @param UserBeneficiaryServiceInterface $userBeneficiaryService
     * @param UserBeneficiaryHttpMapperInterface $userBeneficiaryHttpMapper
     */
    public function __construct(
        UserBeneficiaryService $userBeneficiaryService,
        UserBeneficiaryHttpMapper $userBeneficiaryHttpMapper)
    {
        $this->userBeneficiaryService = $userBeneficiaryService;
        $this->userBeneficiaryHttpMapper = $userBeneficiaryHttpMapper;
    }


    /**
     * @param string $userId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(
        string $userId,
        Request $request
    ){

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'UserBeneficiary' => $this->userBeneficiaryService->create(
                        $this->userBeneficiaryHttpMapper::createUserBeneficiaryFromHttpRequest(
                            $request
                        ),
                        $userId
                    )->toArray()
                ]
            ]

        );


    }
}
