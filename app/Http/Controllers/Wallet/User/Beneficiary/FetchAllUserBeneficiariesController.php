<?php


namespace App\Http\Controllers\Wallet\User\Beneficiary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Wallet\User\Beneficiary\Service\UserBeneficiaryServiceInterface;

class FetchAllUserBeneficiariesController extends Controller
{

    /**
     * @var UserBeneficiaryServiceInterface
     */
    private $userBeneficiaryService;

    /**
     * FetchAllUserBeneficiariesController constructor.
     * @param UserBeneficiaryService $userBeneficiaryService
     */
    public function __construct(UserBeneficiaryServiceInterface $userBeneficiaryService)
    {
        $this->userBeneficiaryService = $userBeneficiaryService;
    }


    public function fetchAll(
        string $userId,
        Request $request
    ){
        return response()->json([
                "status" => "success",
                "data" => [
                    "UserBeneficiaries" => $this
                    ->userBeneficiaryService
                    ->fetchAll([],$userId)
                    ->toArray()
                ]
            ]);
    }
}
