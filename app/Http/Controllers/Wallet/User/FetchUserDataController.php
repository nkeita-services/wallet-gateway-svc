<?php


namespace App\Http\Controllers\Wallet\User;

use App\Http\Controllers\Controller;
use Wallet\Wallet\User\Service\Exception\UserNotFoundException;
use Wallet\Wallet\User\Service\UserService;
use Wallet\Wallet\User\Service\UserServiceInterface;
use Illuminate\Http\Request;

class FetchUserDataController extends Controller
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

    public function fetch($userId, Request $request)
    {

        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => [
                        'walletAccountUser' => $this->userService->fetch($userId)->toArray()
                    ]
                ]

            );
        } catch (UserNotFoundException $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => 0,
                    'StatusDescription' => $e->getMessage()
                ], 404
            );
        }
    }
}
