<?php


namespace App\Http\Controllers\Wallet\User;

use App\Http\Controllers\Controller;
use Wallet\Wallet\User\Service\UserService;
use Wallet\Wallet\User\Service\UserServiceInterface;
use Illuminate\Http\Request;

class FetchAllUsersController extends Controller
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

    public function fetchAll(
        Request $request
    ){
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccountUsers' => $this
                        ->userService
                        ->fetchAll([])
                        ->toArray()
                ]
            ]
        );
    }
}
