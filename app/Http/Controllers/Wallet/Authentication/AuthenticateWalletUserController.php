<?php


namespace App\Http\Controllers\Wallet\Authentication;

use App\Http\Controllers\Controller;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Wallet\Wallet\Document\Service\ComplianceServiceInterface;
use Wallet\Wallet\User\Service\Authentification\AuthenticationServiceInterface;
use Wallet\Wallet\User\Entity\AwsRequestEntity;
use Wallet\Wallet\User\Service\UserServiceInterface;

class AuthenticateWalletUserController extends Controller
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $userAuthenticationService;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var ComplianceServiceInterface
     */
    private $complianceService;


    /**
     * AuthenticateWalletUserController constructor.
     * @param AuthenticationServiceInterface $userAuthenticationService
     * @param UserServiceInterface $userService
     * @param ComplianceServiceInterface $complianceService
     */
    public function __construct(
        AuthenticationServiceInterface $userAuthenticationService,
        UserServiceInterface $userService,
        ComplianceServiceInterface $complianceService

    ) {
        $this->userAuthenticationService = $userAuthenticationService;
        $this->userService = $userService;
        $this->complianceService = $complianceService;
    }


    /**
     * @param string $userName
     * @param string $userPassword
     * @return JsonResponse
     */
    public function authenticate(
        string $userName,
        string $userPassword
    ) {
        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $this->userAuthenticationService->authenticate(
                        AwsRequestEntity::fromArray(
                            [
                                'email' => urldecode($userName),
                                'username' => urldecode($userName),
                                'password' => urldecode($userPassword)
                            ]
                        )
                    )
                ]

            );
        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $c->getStatusCode(),
                    'StatusDescription' => $c->getAwsErrorMessage()
                ] , $c->getStatusCode()
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 401
            );
        }
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function userAuthenticate(
        Request $request
    ) {
        $validator = Validator::make(
            $request->json()->all(),
            [
                'userName' => ['required', 'email'],
                'userPassword' => ['required', 'string'],
                #'userIp' => ['required', 'string']
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => "0000",
                    'StatusDescription' => $validator->errors()
                ]
            );
        }

        $deviceToken = $request->get('deviceToken', "");
        $deviceOs = $request->get('deviceOs', "");

        try {

            $userAuthentication = $this
                ->userAuthenticationService
                ->authenticate(
                    AwsRequestEntity::fromArray(
                        [
                            'email' => urldecode($request->json()->get('userName')),
                            'username' => urldecode($request->json()->get('userName')),
                            'password' => urldecode($request->json()->get('userPassword'))
                        ]
                    )
                );


            if ($deviceToken &&  $deviceOs) {

                $userEntity = $this
                    ->userService
                    ->fetch(
                        $userAuthentication['userId']
                    );
                $userEntity->setDevice(
                    [
                        "deviceToken" => $deviceToken,
                        "deviceOs" => $deviceOs,
                    ]
                );

                $this->userService->update(
                    $userAuthentication['userId'],
                    $userEntity->toArray()
                );
            }


            /*$this->complianceService->getUserKyc(
                $userAuthentication['userId']
            );*/

        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $c->getStatusCode(),
                    'StatusDescription' => $c->getAwsErrorMessage()
                ] , $c->getStatusCode()
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 401
            );
        }


        return response()->json(
            [
                'status' => 'success',
                'data' => $userAuthentication
            ]
        );
    }

    /**
     * @param string $userName
     * @return JsonResponse
     */
    public function forgotPassword(string $userName)
    {
        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $this
                        ->userAuthenticationService
                        ->forgotPassword(
                            urldecode($userName)
                    )
                ]
            );
        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'code' =>$c->getStatusCode(),
                    'message' => $c->getAwsErrorMessage()
                ] , $c->getStatusCode()
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 401
            );
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function confirmForgotPassword(Request $request)
    {
        try {

            $validator = Validator::make(
                $request->json()->all(),
                [
                    'userName' => ['required', 'email'],
                    'userPassword' => ['required', 'string'],
                    'confirmationCode' => ['required', 'digits:6', 'string'],
                ]
            );

            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'StatusCode' => "0000",
                        'StatusDescription' => $validator->errors()
                    ]
                );
            }

            $this
                ->userAuthenticationService
                ->confirmForgotPassword(
                    urldecode($request->json()->get('userName')),
                    urldecode($request->json()->get('userPassword')),
                    $request->json()->get('confirmationCode')
                );

            return response()->json(
                [
                    'status' => 'success',
                    'data' => ""
                ]
            );
        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $c->getStatusCode(),
                    'StatusDescription' => $c->getAwsErrorMessage()
                ] , $c->getStatusCode()
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 401
            );
        }
    }

    /**
     * @param string $accessToken
     * @param string $previousPassword
     * @param string $proposedPassword
     * @return JsonResponse
     */
    public function changePassword(
        string $accessToken,
        string $previousPassword,
        string $proposedPassword
    ) {
        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $this
                        ->userAuthenticationService
                        ->changePassword(
                            urldecode($accessToken),
                            urldecode($previousPassword),
                            urldecode($proposedPassword)
                        )
                ]
            );
        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $c->getStatusCode(),
                    'StatusDescription' => $c->getAwsErrorMessage()
                ] , $c->getStatusCode()
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 401
            );
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function disableUser(Request $request)
    {
        $validator = Validator::make(
            $request->json()->all(),
            [
                'userName' => ['required', 'email'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => "0000",
                    'StatusDescription' => $validator->errors()
                ]
            );
        }

        $userName = $request->json()->get('userName');

        try {
            $this
                ->userAuthenticationService
                ->disableUser(
                    urldecode($request->json()->get('userName'))
                );

        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $c->getStatusCode(),
                    'StatusDescription' => $c->getAwsErrorMessage()
                ] , $c->getStatusCode()
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 401
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'email'=> urldecode($userName),
                    'information' => "User is disabled successfully"
                ]
            ]
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function enableUser(Request $request)
    {
        $validator = Validator::make(
            $request->json()->all(),
            [
                'userName' => ['required', 'email'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => "0000",
                    'StatusDescription' => $validator->errors()
                ]
            );
        }

        $userName = $request->json()->get('userName');

        try {
            $this
                ->userAuthenticationService
                ->enableUser(
                    urldecode( urldecode($request->json()->get('userName')))
                );

        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $c->getStatusCode(),
                    'StatusDescription' => $c->getAwsErrorMessage()
                ] , $c->getStatusCode()
            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => $exception->getMessage()
                ], 401
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'email'=> urldecode($userName),
                    'information' => "User is enabled"
                ]
            ]
        );
    }
}
