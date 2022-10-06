<?php


namespace App\Http\Controllers\Wallet\User;


use App\Http\Controllers\Controller;
use App\Rules\Wallet\WalletPlanIdRule;
use App\Rules\Wallet\WalletUserIdRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Wallet\Wallet\User\Service\UserService;
use Wallet\Wallet\User\Service\UserServiceInterface;

class FetchAllAppUsersController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * FetchUserDataController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function fetchAllAppUser(
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
                    'StatusCode'=> 0,
                    'StatusDescription'=> $validator->errors()
                ]
            );
        }

        /*$requestMobilesNumber = collect($request->json()
            ->get('mobileNumbers'));*/

        $appUsers = $this
            ->userService
            ->fetchAllAppUser(
                [
                    'mobileNumbers' => $request
                        ->json()
                        ->get('mobileNumbers')
                ]
            );

        //var_dump($appUsers);

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccountUserMobile' => $appUsers
                ]
            ]
        );
    }
}
