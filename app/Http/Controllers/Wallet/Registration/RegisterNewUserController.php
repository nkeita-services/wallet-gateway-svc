<?php


namespace App\Http\Controllers\Wallet\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Wallet\Wallet\User\Entity\UserEntity;
use Wallet\Wallet\User\Service\Authentification\AuthenticationServiceInterface;
use Wallet\Wallet\User\Service\UserServiceInterface;

class RegisterNewUserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var AuthenticationServiceInterface
     */
    private $userAuthenticationService;


    /**
     * RegisterNewUserController constructor.
     * @param UserServiceInterface $userService
     * @param AuthenticationServiceInterface $userAuthenticationService
     */
    public function __construct(
        UserServiceInterface $userService,
        AuthenticationServiceInterface $userAuthenticationService
    )
    {
        $this->userService = $userService;
        $this->userAuthenticationService = $userAuthenticationService;
    }


    public function register(
        Request $request
    )
    {
        $validator = Validator::make(
            $request->json()->all(),
            [
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
                'group' => ['required', 'string'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => 0000,
                    'StatusDescription' => $validator->errors()
                ]
            );
        }

        $this
            ->userAuthenticationService
            ->register(
                $request->get('email'),
                $request->get('password'),
                $request->get('email')
            )->addUserToGroup(
                $request->get('email'),
                $request->get('group')
            );


        $userEntity = $this
            ->userService
            ->create(
                UserEntity::fromArray(
                    [
                        'email' => $request->get('email'),
                        'walletOrganizations' => $request->get('ApiConsumer')->getOrganizations()
                    ]
                ),
                $request->get('ApiConsumer')->getOrganizations()
            );

        return response()->json(
            [
                'status' => 'success',
                'data'=> [
                    'walletAccountUser'=> $userEntity->toArray()
                ]
            ]
        );
    }
}
