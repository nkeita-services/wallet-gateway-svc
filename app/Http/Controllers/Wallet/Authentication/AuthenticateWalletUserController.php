<?php


namespace App\Http\Controllers\Wallet\Authentication;

use App\Http\Controllers\Controller;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;
use Exception;
use Illuminate\Http\JsonResponse;
use Wallet\Wallet\User\Service\Authentification\AuthenticationServiceInterface;

class AuthenticateWalletUserController extends Controller
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $userAuthenticationService;

    /**
     * AuthenticateWalletUserController constructor.
     * @param AuthenticationServiceInterface $userAuthenticationService
     */
    public function __construct(AuthenticationServiceInterface $userAuthenticationService)
    {
        $this->userAuthenticationService = $userAuthenticationService;
    }


    /**
     * @param string $userName
     * @param string $userPassword
     * @return JsonResponse
     */
    public function authenticate(
        string $userName,
        string $userPassword
    )
    {
        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $this->userAuthenticationService->authenticate(
                        urldecode($userName),
                        urldecode($userPassword)
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
}
