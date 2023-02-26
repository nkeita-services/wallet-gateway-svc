<?php


namespace App\Http\Controllers\Wallet\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Wallet\Wallet\User\Service\UserService;
use Wallet\Wallet\User\Service\UserServiceInterface;

class FetchAllNonAppUsersController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * FetchUserDataController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fetchAllNonAppUser(
        Request $request
    ){
        $validator = Validator::make(
            $request->all(),
            [
                'mobileNumbers' => ['required', 'array']
            ]
        );

        if($validator->fails()){
            return response()->json(
                [
                    'status' => 'error',
                    'statusCode'=> 0,
                    'statusDescription'=> $validator->errors()
                ]
            );
        }

        $requestMobilesNumber = collect($request->json()
            ->get('mobileNumbers'));

        $appUsers = $this
            ->userService
            ->fetchAllAppUser(
                [
                    'mobileNumbers' => $request
                        ->json()
                        ->get('mobileNumbers')
                ]
            );

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccountUserMobile' => array_values
                    (
                        $requestMobilesNumber
                            ->diff(
                                collect(
                                    $appUsers
                                )->pluck('mobileNumber')
                            )->all()
                    )
                ]
            ]
        );
    }
}
