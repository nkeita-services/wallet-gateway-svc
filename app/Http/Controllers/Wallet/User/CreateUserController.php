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
     * @param UserMapper $userMapper
     * @param UserService $userService
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
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'walletAccountUser' => $this->userService->create(
                        $this->userMapper::createUserFromHttpRequest(
                            $request
                        ),
                        $request->get('ApiConsumer')->getOrganizations()
                    )->toArray()
                ]
            ]

        );
    }
}
