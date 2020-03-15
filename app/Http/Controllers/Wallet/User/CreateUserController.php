<?php


namespace App\Http\Controllers\Wallet\User;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Wallet\User\Mapper\UserMapper;
use App\Http\Controllers\Wallet\User\Mapper\UserMapperInterface;
use Wallet\Wallet\User\Service\UserService;
use Wallet\Wallet\User\Service\UserServiceInterface;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{

    /**
     * @var UserMapperInterface
     */
    private $userMapper;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * CreateUserController constructor.
     * @param UserMapperInterface $userMapper
     * @param UserServiceInterface $userService
     */
    public function __construct(
        UserMapper $userMapper,
        UserService $userService
    )
    {
        $this->userMapper = $userMapper;
        $this->userService = $userService;
    }


    public function create(Request $request)
    {
        if (!$request->get('ApiConsumer')->hasScope('wallet-gateway/CreateUsers')) {
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
            [
                'status' => 'success',
                'data' => $this->userService->create(
                    $this->userMapper::createUserFromHttpRequest(
                        $request
                    )
                )->toArray()
            ]

        );
    }
}
