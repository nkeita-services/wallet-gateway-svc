<?php


namespace App\Http\Controllers\Wallet\Registration;

use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Wallet\Wallet\User\Entity\UserEntity;
use Wallet\Wallet\User\Service\Authentification\AuthenticationServiceInterface;
use Wallet\Wallet\User\Service\Exception\UserNotFoundException;
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
                'mobileNumber' => ['required', 'string','regex:/^([0-9\s\-\+\(\)]*)$/','min:10'],
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

        try{

            $userEntity = $this
                ->userService
                ->create(
                    UserEntity::fromArray(
                        [
                            'email' => $request->get('email'),
                            'mobileNumber' => $request->get('mobileNumber'),
                            'walletOrganizations' => $request->get('ApiConsumer')->getOrganizations()
                        ]
                    ),
                    $request->get('ApiConsumer')->getOrganizations()
                );

            $this
                ->userAuthenticationService
                ->register(
                    $request->get('email'),
                    $request->get('password'),
                    $request->get('email'),
                    $request->get('mobileNumber'),
                    $userEntity->getUserId()
                )->addUserToGroup(
                    $request->get('email'),
                    $request->get('group')
                );
        } catch (UserNotFoundException $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 404
            );
        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $c->getStatusCode(),
                    'StatusDescription' => $c->getAwsErrorMessage()
                ], 404
            );
        }

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
