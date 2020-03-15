<?php


namespace App\Http\Controllers\Wallet\User;

use App\Http\Controllers\Controller;
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
        if(!$request->get('ApiConsumer')->hasScope('wallet-gateway/GetUser')){
            return response()->json(
                [
                    'status' => 'failure',
                    'statusCode' => 0,
                    'statusDescription' => "You don't seem to have enough permissions to perform this action"
                ],
                401
            );
        }

        return response()->json(
            $this->userService->fetch($userId)->toArray()
        );
    }
}
