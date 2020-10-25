<?php


namespace App\Http\Controllers\Wallet\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Wallet\User\Entity\UserEntity;
use Wallet\Wallet\User\Service\Authentification\AuthenticationServiceInterface;
use Wallet\Wallet\User\Service\UserServiceInterface;

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
