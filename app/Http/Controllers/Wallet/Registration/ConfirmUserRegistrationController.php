<?php


namespace App\Http\Controllers\Wallet\Registration;

use App\Http\Controllers\Controller;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Illuminate\Http\JsonResponse;
use Wallet\Wallet\User\Service\Authentification\AuthenticationServiceInterface;

class ConfirmUserRegistrationController extends Controller
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $userAuthenticationService;


    /**
     * RegisterNewUserController constructor.
     * @param AuthenticationServiceInterface $userAuthenticationService
     */
    public function __construct(
        AuthenticationServiceInterface $userAuthenticationService
    ) {
        $this->userAuthenticationService = $userAuthenticationService;
    }


    /**
     * @param string $userName
     * @param string $code
     * @return JsonResponse
     */
    public function confirm(
        string $userName,
        string $code
    ) {

        try {
            $this
                ->userAuthenticationService
                ->confirmRegistration(
                    urldecode($userName),
                    $code
                );
        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'statusCode' => $c->getStatusCode(),
                    'statusDescription' => $c->getAwsErrorMessage()
                ]
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'data'=> [
                    'email'=> urldecode($userName)
                ]
            ]
        );
    }

    /**
     * @param string $userName
     * @return JsonResponse
     */
    public function resendConfirmationCode(
        string $userName
    ) {
        try {
            $this
                ->userAuthenticationService
                ->resendConfirmationCode(
                    urldecode($userName)
                );
        } catch(CognitoIdentityProviderException $c) {
            return response()->json(
                [
                    'status' => 'error',
                    'statusCode' => $c->getStatusCode(),
                    'statusDescription' => $c->getAwsErrorMessage()
                ]
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'data'=> [
                    'message' => 'Code resent successfully',
                    //'email'=> urldecode($userName)
                ]
            ]
        );
    }
}
