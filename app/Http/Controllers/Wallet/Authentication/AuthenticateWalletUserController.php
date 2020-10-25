<?php


namespace App\Http\Controllers\Wallet\Authentication;

use App\Http\Controllers\Controller;
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
     * @param string $username
     * @param string $userPassword
     * @return JsonResponse
     */
    public function authenticate(
        string $username,
        string $userPassword
    )
    {
        try {


            return response()->json(
                [
                    'status' => 'success',
                    'data' => [
                        'accessToken' => $this->userAuthenticationService->authenticate(
                            $username,
                            $userPassword
                        ),
                        'expires_in' => 3600,
                        'tokenType' => 'Bearer'
                    ]
                ]

            );
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => 0,
                    'StatusDescription' => $exception->getMessage()
                ], 401
            );
        }
    }
}
