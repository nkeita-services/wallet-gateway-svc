<?php


namespace App\Http\Controllers\Wallet\Registration;

use App\Http\Controllers\Controller;
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
    )
    {
        $this->userAuthenticationService = $userAuthenticationService;
    }


    public function confirm(
        string $userName,
        string $code
    )
    {

        $this
            ->userAuthenticationService
            ->confirmRegistration(
                urldecode($userName),
                $code
            );

        return response()->json(
            [
                'status' => 'success',
                'data'=> [
                    'email'=>urldecode($userName)
                ]
            ]
        );
    }
}
